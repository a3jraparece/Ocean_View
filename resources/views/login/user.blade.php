<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ocean View</title>
    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100 flex-col">


        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-center text-gray-700">Welcome Back</h2>
            <form class="space-y-4" action="{{ route('login.user.verify') }}" method="POST">
                @csrf
                @method('post')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Enter your username" value="{{ old('username') }}" name="username">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Enter your password" name="password">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" class="mr-2 border-gray-300 rounded">
                        Remember me
                    </label>
                    <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                </div>
                <button
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">Login</button>
            </form>
            <p class="text-sm text-center text-gray-600">Don't have an account? <a
                    href="{{ route('login.user.register') }}" class="text-blue-500 hover:underline">Sign up</a></p>
        </div>
    </div>

</body>

</html>
