<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resort Name')</title>
    <link rel="stylesheet" href="@yield('css')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/user/layout.css') }}">
</head>

<body>
    <header>
        @if (session()->has('guest'))
            <!-- Centered Resort Name -->
            <div>
                <a href="{{ route('user.index') }}">
                    <img src="{{ asset('/images/icons/user/home.png') }}" alt="User Icon" width="30px">
                </a>
            </div>
            <div class="resort-name">
                <a href="{{ route('user.index') }}">
                    Ocean View
                </a>
            </div>

            <div class="user-profile">
                @if (session()->has('currentResort'))
                    <a href="#">Chat Icon </a>
                @endif
                <span> {{ session('guest')['username'] }}</span>
                <img src="{{ asset('/images/icons/user/user.png') }}" alt="User Icon" onclick="showNav()">
                <nav id="layoutnavbar">
                    <a href="{{ route('user.my_account') }}">My Account</a>
                    <a href="{{ route('user.transcation_history') }}">Transcation History</a>
                    <a href="{{ route('user.bookmarks') }}">Bookmarks</a>
                    <a href="{{ route('user.my_reservations') }}">My Reservations</a>
                    <a href="{{ route('user.logout') }}">Log Out</a>
                </nav>
            </div>
        @else
            <div>
                <a href="{{ route('user.index') }}">
                    <img src="{{ asset('/images/icons/user/home.png') }}" alt="User Icon" width="30px">
                </a>
            </div>
            <a href="{{ route('login.user') }}">Log In</a>
        @endif
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        let layoutnavbarShowed = true;

        function showNav() {
            if (layoutnavbarShowed) {
                document.getElementById('layoutnavbar').style.display = 'flex';
                layoutnavbarShowed = false;
            } else {
                document.getElementById('layoutnavbar').style.display = 'none';
                layoutnavbarShowed = true;
            }
        }
    </script>
</body>

</html>
