<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>sign-In</title>

</head>

<body>

    <div class="landing">
        <h1>Welcome Back, Challenger</h1>

        <p>Sign in to challenge other developers and keep your information up to dates</p>

        <div class="form-box">

            @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
            @endif

            @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
            @endif

            <form method="post" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Sign In</button>
            </form>

            <p>
                Don’t have an account?
                <a href="./registry">Create one</a>
            </p>

        </div>
    </div>

</body>

</html>