<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/chooseCategory.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>choose-category</title>
</head>

<body>

    <div class="landing">
        @if (session('error'))
        <div class="error">
            {{ session('error') }}
            <a href="/about">more details</a>
        </div>
        @endif
        <h1>Choose a category</h1>
        <p class="extra-message">Select a category below to start your quiz and test your info!</p>
        <div class="cards">
            @foreach (['public', 'Back end', 'Front end', 'NodeJs', 'Laravel', 'React'] as $item)
            <a href="{{ route('questions.exam', ['category' => $item]) }}">{{ $item }}</a>
            @endforeach
        </div>
        <a href="/">BACK</a>
    </div>
</body>

</html>