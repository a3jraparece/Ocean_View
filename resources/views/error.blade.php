<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6e6;
            color: #a94442;
            font-family: 'Arial', sans-serif;
        }

        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .error-title {
            font-size: 8rem;
            font-weight: bold;
            color: #d9534f;
        }

        .error-message {
            font-size: 1.5rem;
            margin: 20px 0;
        }

        .btn-home {
            margin-top: 20px;
            color: #fff;
            background-color: #d9534f;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-home:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-title">Error</div>
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @else
            <p class="error-message">Oops! Something went wrong. Please try again later.</p>
        @endif
        <button class="btn-home" onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
