<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/examResult.css') }}">
    <title>Exam Results</title>
</head>

<body>

    <section>
        <h1>Congratulations</h1>
        <p>You’ve completed the exam! Take a moment to review your results below and be proud of the effort you put in.</p>
    </section>

    <div class="landing">
        <div class="statistics">
            <p><strong>Score:</strong> {{ $score }} / 20</p>
            <p><strong>Questions Total:</strong> {{count($result)}}</p>
            <h4>Your Answers:</h4>
        </div>

        @foreach($result as $index => $answer)
        <div class="question-parent">
            <span>Question {{ $index + 1 }}</span>
            <span>{{ $answer->question }}</span>
            <span>Your Answer: {{ $answer->user_answer }}</span>
            <span>Correct Answer: {{ $answer->question_answer }}</span>
            <span>Points Awarded: {{ $answer->points }}</span>
        </div>
        @endforeach
        <a href="/">Home Page</a>
    </div>


</body>

</html>