<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User_Answers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAnswersController extends Controller
{
    public function getExamResult($examOrder, $category)
    {
        $user = Auth::user();

        if (!$examOrder) {
            return redirect()->route('home')->with('error', 'exam order is required');
        }

        $result = User_Answers::select(
            'questions.question',
            'questions.answer as question_answer',
            'user__answers.points',
            'user__answers.is_correct',
            'user__answers.answer as user_answer'
        )
            ->join('questions', 'user__answers.question_id', '=', 'questions.id')
            ->join('users', 'user__answers.user_id', '=', 'users.id')
            ->where('users.id',  $user->id)
            ->where('user__answers.exam_order', $examOrder)
            ->where('user__answers.category', $category)
            ->get();

        if (!$result || $result->isEmpty()) {
            return redirect()->route('home')->with('error', 'exam is not found');
        }

        $score = $result->sum('points');


        return view('examResult', compact('result', 'score',));
    }

    public function getRansks()
    {
        $categories = ['react', 'nodejs', 'Front end', 'Back end', 'public', 'laravel'];

        $globalLeader = User_Answers::select(
            'users.userName',
            'users.avatar',
            DB::raw('SUM(user__answers.points) as total_points'),
            DB::raw('MAX(user__answers.exam_order) as last_exam'),
            DB::raw('MAX(user__answers.created_at) as last_date')
        )
            ->join('users', 'user__answers.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.userName', 'users.avatar')
            ->orderByDesc('total_points')
            ->first();

        $categoryRanks = [];

        foreach ($categories as $category) {
            $users = User_Answers::select(
                'users.userName',
                'users.avatar',
                DB::raw('SUM(user__answers.points) as total_points'),
                'user__answers.exam_order',
                'user__answers.created_at'
            )
                ->join('users', 'user__answers.user_id', '=', 'users.id')
                ->where('user__answers.category', $category)
                ->groupBy('users.id', 'users.userName', 'users.avatar', 'user__answers.exam_order', 'user__answers.created_at')
                ->orderByDesc('total_points')
                ->get();

            $categoryRanks[$category] = $users;
        }

        return view('ranks', compact('globalLeader', 'categoryRanks'));
    }
}
