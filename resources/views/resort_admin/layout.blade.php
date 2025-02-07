<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resort Name')</title>
    <link rel="stylesheet" href="@yield('css')">
    <style>
        header {
            background-color: white;
            border-bottom: 2px solid #d6c9c9;
            display: flex;
            align-items: center;
            justify-content: end;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-profile {
            display: flex;
            align-items: center;
        }

        .resort-name {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .resort-name a {
            font-weight: bold;
            font-size: 18px;
            text-transform: uppercase;
            text-decoration-line: none;
            letter-spacing: 3px;
            word-spacing: 4px;
            color: black;
        }

        .admin-profile {
            font-size: 14px;
        }

        .admin-profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 8px;
        }

        nav {
            border-right: 1px solid grey;
            position: absolute;
            top: 0;
            left: 0;
            background-color: white;
            z-index: 99;
            height: 100vh;
            display: none;
            flex-direction: column;
        }

        nav div {
            padding: 10px;
            display: flex;
            justify-content: end;
            align-items: center;
        }

        nav a {
            width: 200px;
            padding: 5px 10px 5px 20px;
            text-decoration-line: none;
        }

        nav a:hover {
            background-color: rgb(215, 215, 215);
        }

        #menu {
            position: absolute;
            top: 10px;
            left: 30px;
            z-index: 100;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

    <header>
        <div id="menu">
            <img src="{{ asset('/images/icons/burger-bar.png') }}" alt="" width="30px" onclick="navbar()"
                id="navbarimg">
        </div>
        <nav id="navbar">
            <div></div>
            <div></div>
            <div></div>
            <a href="{{ route('resort_admin.index') }}" class="atohide"> Dashoard </a>
            <a href="{{ route('resort_admin.manage') }}" class="atohide">Manage Resort</a>
            <a href="{{ route('resort_admin.rooms') }}" class="atohide">Rooms</a>
            <a href="{{ route('resort_admin.reservations') }}" class="atohide">Reservations</a>
            <a href="" class="atohide">Guest Support</a>
            <a href="" class="atohide">Transaction</a>
            <a href="" class="atohide">Events</a>
        </nav>

        <div class="resort-name">
            {{ session('resort')['resort_name'] }}
        </div>
        <!-- Right Admin Section -->
        <div class="admin-profile">
            <span><a href="{{ route('resort_admin.logout') }}">Log Out </a></span>
            <span> | Resort Admin</span>
            <img src="{{ asset('/images/icons/user/user.png') }}" alt="User Icon">
        </div>
    </header>

    <main>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <script>
        let navbaropened = false;

        function navbar() {

            const navbar = document.getElementById('navbar');
            const navbarmenu = document.getElementById('menu');

            if (navbaropened) {
                navbar.style.display = 'none';
                navbarmenu.style.left = '30px';
                navbaropened = false;
            } else {
                navbar.style.display = 'flex';
                navbarmenu.style.left = '150px';
                navbaropened = true;
            }

        }
    </script>
</body>

</html>
