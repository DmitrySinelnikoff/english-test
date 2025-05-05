<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <header class="dashboard-header">
        <div class="dashboard-header-logo">
            <a href="{{ route('main') }}" class="white-text">wordexamtest</a>
        </div>
        <div class="center-container">
            <form method="POST" action="{{ route('search.index')}}" class="search-form" onsubmit="return validateSearch()">
                @csrf
                <input type="text" name="search" value="{{ old('name') }}" class="search-input" id="searchText">
                <input type="submit" value="🔍" class="search-button">
            </form>
        </div>
        <div class="dashboard-header-nav" id="nav-menu">
            @auth
            <div class="dashboard-header-logo" id="accaunt">
                <a href="{{ route('home') }}" class="white-text">Аккаунт</a>
            </div>
            <div id="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" value="Выйти">
                </form>
            </div>
            @endauth
            @guest
            <div class="dashboard-header-logo" id="auth">
                <a href="{{ route('login') }}" class="white-text">Войти</a>
            </div>
            @endguest
        </div>
    </header>
    <div class="about-body">
        @yield('content')
    </div>
</body>
</html>
