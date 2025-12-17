<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <title>category</title>
</head>

<body>
    @extends('layout.layout')

    @section('content')
    <div class="landing">
        <h1>{{ $category }}</h1>
        <div class="info-box">
            @if($category == 'Laravel')
            <p><strong>Laravel</strong> is a powerful PHP framework designed to make web development easier, faster, and more secure. It provides built-in tools for routing, authentication, database migrations, and templating with Blade. In quizzes under Laravel, users can test their knowledge on MVC architecture, Eloquent ORM, routing, controllers, and Laravel's built-in features for building scalable web applications. By completing challenges, users can improve their backend PHP skills and gain points for correct answers.</p>
            @elseif($category == 'Nodejs')
            <p><strong>Node.js</strong> is a JavaScript runtime that runs on the server side. It allows developers to create scalable, high-performance applications using event-driven, non-blocking I/O. Users can take quizzes to test their understanding of Node.js concepts such as asynchronous programming, Express.js routing, REST APIs, working with databases like MongoDB, and real-time applications using WebSockets. Completing these challenges helps users gain practical skills for server-side development with JavaScript.</p>
            @elseif($category == 'Front End')
            <p><strong>Front End</strong> development focuses on the user interface and experience of web applications. It uses HTML, CSS, and JavaScript to create interactive, visually appealing websites. Quizzes in this category might cover CSS layouts, responsive design, JavaScript DOM manipulation, animations, and accessibility. Users improve their ability to build responsive and interactive interfaces while earning points for every correct answer.</p>
            @elseif($category == 'Back End')
            <p><strong>Back End</strong> development is all about server-side logic, database management, authentication, and ensuring that web applications function correctly. Quizzes in this category may include questions on server configuration, working with databases like MySQL or MongoDB, API design, authentication strategies, and data security. By completing these challenges, users can strengthen their understanding of the backend processes that power modern web applications.</p>
            @elseif($category == 'React')
            <p><strong>React</strong> is a JavaScript library for building reusable, component-based user interfaces. Users can take quizzes about React concepts like JSX, state management, props, hooks, component lifecycle, and integrating with APIs. These quizzes help users learn to create dynamic, efficient, and maintainable front-end applications while tracking points for each correct answer and advancing through more complex challenges.</p>
            @elseif($category == 'Public')
            <p><strong>Public</strong> challenges are general programming quizzes available to all registered users. These challenges let you test your overall knowledge in areas like programming basics, web development, algorithms, logic, and problem-solving. By completing public quizzes, you earn points that contribute to your overall progress and help you level up. This section is perfect for users who want to build foundational skills and gain experience before exploring specialized topics such as Laravel, React, or databases.</p> @else
            <p>No details available for this category.</p>
            @endif
        </div>
    </div>
    @endsection


</body>

</html>