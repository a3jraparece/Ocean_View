<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resort Name')</title>
    <link rel="stylesheet" href="@yield('css')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    nav {
        padding: 10px
    }

    a {
        padding: 10px;
    }

    
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #b9b9b9;
    color: white;
}

.navbar .menu-icon {
    font-size: 20px;
    cursor: pointer;
}

.navbar .title {
    font-size: 20px;
    display: flex;
    align-items: center;
}

.navbar .title img {
    width: 30px;
    margin-right: 10px;
}

.navbar .admin {
    font-size: 18px;
    display: flex;
    align-items: center;
}

.navbar .admin img {
    width: 25px;
    margin-left: 10px;
}
</style>

<body>

    <header>
        <div class="navbar">
            <div class="menu-icon">☰</div>
            <div class="title">
                {{-- <img src="logo.png" alt="Ocean View Logo"> --}}
                <span>Ocean View</span>
            </div>
            <div class="admin">
                <span>Admin</span>
                {{-- <img src="admin-icon.png" alt="Admin Icon"> --}}
            </div>
        </div>
        <a href="{{ route('admin.index') }}">Dashoard</a>
        <a href="{{ route('admin.resorts') }}">Resorts</a>
        <a href="{{ route('admin.accounts') }}">Customer Accounts</a>
        <a href="{{ route('admin.viewuser') }}">Customer profile</a>

    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
