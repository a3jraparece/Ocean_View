<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resort Admin</title>
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<body>

    <h1>Resort Log In</h1>

    @if (session('error'))
        {{ session('error') }}
    @endif

    <form action="{{ route('login.resort_admin.verify') }}" method="POST">
        @csrf
        @method('post')
        <div>
            <label for="">Username</label>
            <input type="text" name="username" value="{{ old('username') }}">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password">
        </div>
        <input type="Submit">
    </form>

</body>

</html>
