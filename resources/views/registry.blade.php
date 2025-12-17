<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registry.css') }}">
    <title>register</title>

</head>

<body>

    <div class="landing">

        <h1>Join the Challengers 🚀</h1>
        <p>sign up to our website to you can challenge with other developer, also allows you to refresh your information</p>

        <div class="form-box">
            @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
            @endif


            <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf

                <input type="text" name="userName" value="{{ old('userName') }}" placeholder="Username">

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">

                <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">

                <input type="file" name="avatar" accept="image/*">

                <button type="submit">Create Account</button>
            </form>

            <div class="options">
                <a href="./log-in">
                    Already a challenger?
                </a>
                <a href="/">
                    Back
                </a>
            </div>

        </div>

    </div>

</body>

</html>