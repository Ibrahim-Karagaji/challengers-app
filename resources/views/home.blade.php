<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>home</title>
</head>

<body>
    @extends("layout.layout")

    @section('content' )
    <div class="landing">

        @guest
        <img src="{{ asset('images/Anonymous-user.jpg') }}" alt="avatar">
        @endguest

        @auth
        <a href="{{route('user_profile')}}"> <img
                src="{{ Auth::user()->avatar 
            ? asset('storage/' . Auth::user()->avatar) 
            : asset('images/Anonymous-user.jpg') 
        }}"
                alt="avatar"></a>

        @endauth

        @auth
        <h1>Welcome, {{ auth()->user()->userName }}!</h1>
        @endauth

        <a href="/choose-category">
            <h1>Start challenge</h1>
        </a>

        <a href="/about">
            <h3>About the challenge</h3>
        </a>
    </div>
    @endsection
</body>

</html>