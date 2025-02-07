<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log ins</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        ul {
            list-style: none;
        }

        li {
            padding: 10px;
        }
    </style>
</head>

<body>

    <ul>
        <li>
            <a href="{{ route('login.ocean_view') }}">
                <h1>Ocean View Admin Log in</h1>
            </a>
        </li>
        <li>
            <a href="{{ route('login.resort_admin') }}">
                <h1>Resort Admin Log in</h1>
            </a>
        </li>
        <li>
            <a href="{{ route('login.user') }}">
                <h1>User Log In</h1>
            </a>
        </li>
    </ul>
</body>

</html>
