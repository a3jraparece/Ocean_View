<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ocean View</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>

    <h1>User Log In</h1>

    @if (session('error'))
        <div>
            {{ session('error') }}
            <br>
        </div>
    @endif

    <form action="{{ route('login.user.verify') }}" method="POST">
        @csrf
        @method('post')
        <div>
            <label for="">Username</label>
            <input type="text" name="username"value="{{ old('username') }}" required>
        </div>
        <div>
            <label for="">Passowrd</label>
            <input type="password" name="password" required>
        </div>
        <input type="Submit">
        <a href="{{ route('login.user.register') }}">Register</a>
    </form>
</body>

</html>
