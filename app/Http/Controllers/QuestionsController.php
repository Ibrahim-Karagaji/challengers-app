<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Daily_Attempts;
use App\Models\Questions;
use App\Models\User_Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function start_exam($category)
    {
        $user = Auth::user();

        $dailyAttempts = Daily_Attempts::where('user_id', $user->id)->where('category', $category)->where('date', date('Y-m-d'))->first();

        if ($dailyAttempts) {
            if ($dailyAttempts->attempts >= 3) {
                return back()->with('error', 'You have reached the daily limit exams of this category');
            }
        }

        $questions = Questions::where('category', $category)->inRandomOrder()->limit(10)->get();

        if (count($questions) !== 10) {
            return back()->with('error', 'there are not enough questions available in this category to start the quiz');
        }

        session(['questions' => $questions]);

        return view('exam', compact('questions'));
    }

    public function submitAnswers(Request $request)
    {
        $user = Auth::user();
        $answers = $request->input('answers', []);
        $questions = session('questions');

        if (!$questions) {
            return redirect()->back()->with('error', 'please start the exam again');
        }

        $dailyAttempt = Daily_Attempts::where('user_id', $user->id)
            ->where('category', $questions[0]->category)
            ->where('date', date('Y-m-d'))
            ->first();

        $examOrder = $dailyAttempt ? $dailyAttempt->attempts + 1 : 1;

        foreach ($questions as $index => $question) {
            if (!isset($answers[$index])) {
                return redirect()->back()->with('error', 'please answer all questions');
            }
        }

        foreach ($questions as $index => $question) {
            $correct = $question->answer;

            User_Answers::create([
                'user_id'     => $user->id,
                'question_id' => $question->id,
                'answer'      => $answers[$index],
                'category'    => $question->category,
                'exam_order'  => $examOrder,
                'is_correct'  => $answers[$index] === $correct,
                'points'      => $answers[$index] === $correct ? 2 : 0,
            ]);
        }

        if ($dailyAttempt) {
            $dailyAttempt->increment('attempts');
        } else {
            Daily_Attempts::create([
                'user_id'  => $user->id,
                'date'     => date('Y-m-d'),
                'category' => $questions[0]->category,
                'attempts' => 1,
            ]);
        }

        session()->forget('questions');

        return redirect()->route('exam.result', [
            'examOrder' => $examOrder,
            'category'  => $questions[0]->category
        ]);
    }
}
