<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
    <style>
    </style>
</head>

<body>

    @extends("layout.layout" )

    @section('content')
    <div class="landing">
        <h1>Categories</h1>
        <p>Explore the different categories of quizzes and challenges to improve your skills and test your knowledge!</p>

        <div class="cards">
            <a href="{{ route('category.show' , ['name' => 'Laravel']) }}" class="card">Laravel</a>
            <a href="{{ route('category.show' , ['name'=> 'Nodejs']) }}" class="card">Nodejs</a>
            <a href="{{ route('category.show' , ['name'=> 'Front End']) }}" class="card">Front End</a>
            <a href="{{ route('category.show' , ['name'=> 'Back End']) }}" class="card">Back End</a>
            <a href="{{ route('category.show' , ['name'=> 'React']) }}" class="card">React</a>
            <a href="{{ route('category.show' , ['name'=> 'Public']) }}" class="card">Public</a>
        </div>
    </div>
    @endsection

</body>

</html>