<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
    <h1>User Regsiter</h1>
    <form action="">
        <div>
            <label for="">Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">password</label>
            <input type="text" name="username">
        </div>
        <a href="{{ url('/Ocean View/login/user') }}">Cancel</a>
        <input type="Submit" value="Register">
    </form>
</body>

</html>
