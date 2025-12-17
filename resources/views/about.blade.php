<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <title>about</title>
</head>

<body>
    @extends("layout.layout")

    @section('content' )
    <div class="landing">
        <h1>About Challengers</h1>

        <div class="info-box">
            <h3>What is "Challengers"?</h3>
            <p>
                Challengers is a project quiz platform where users can test their knowledge
                in categories like React, Node.js, Laravel, Front End, and Back End.
                Each quiz lets you answer questions, earn points, and track your daily progress.
            </p>

            <h3>What happens after you sign up?</h3>
            <ul class="steps">
                <li>Create an account and become a Challenger.</li>
                <li>Choose a category and start your daily quiz.</li>
                <li>Answer questions and earn points for every correct answer.</li>
                <li>Track your attempts — each user has a <strong>maximum of 3 exams per day per category</strong>.</li>
            </ul>

            <h3>How do you win?</h3>
            <p>
                Complete more quizzes and earn points to improve your ranking.
                Your performance is saved, and top scorers in each category stand out as Challengers champions.
            </p>
        </div>
    </div>


    @endsection

</body>

</html>