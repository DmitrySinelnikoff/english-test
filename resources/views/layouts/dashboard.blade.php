<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('js/select2/css/select2.min.css') }}">
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
        <div class="dashboard-header-logo mobile-button click" id="mobile-menu">︙</div>
    </header>
    <div class="dashboard-sidebar" id="sidebar">
        <a href="{{ route('word.index') }}" class="dashboard-button">Английские слова</a>
        <a href="{{ route('russian.word.index') }}" class="dashboard-button">Русские слова</a>
        <a href="{{ route('tags.index') }}" class="dashboard-button">Категории тестов</a>
        <a href="{{ route('part-of-speech.index') }}" class="dashboard-button">Части речи</a>
        <a href="{{ route('wordtest.list') }}" class="dashboard-button">Ваши тесты</a>
        <a href="{{ route('statistics.index') }}" class="dashboard-button">Статистика</a>
        @auth
            <a href="{{ route('suggest.create') }}" class="dashboard-button">Предложить слово</a>
            <a href="{{ route('feedback.create') }}" class="dashboard-button">Обратная связь</a>
        @endauth
        @if(auth()->check() && Auth::user()->user_role_id == 2)
            <a href="{{ route('suggest.index') }}" class="dashboard-button">Предложенные слова</a>
            <a href="{{ route('user.index') }}" class="dashboard-button">Пользователи</a>
        @endif
    </div>
    <div class="dashboard-body">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2/js/select2.full.min.js') }}"></script>
    <script>
        @yield('script')

        $('#testForm').on('submit', function(e) {
            if($('input:checked').length === 0) {
                e.preventDefault();
            }
        });

        function validateSearch() {
            if (document.getElementById("searchText").value == "" ) {
                alert("Для поиска необходимо заполнить поле!");
                return false;
            } else {
                return true;
            } 
        }

        let mobileButton = document.getElementById('mobile-menu');
        mobileButton.addEventListener('click', function(menuClick) {
            document.getElementById('sidebar').classList.toggle('dashboard-sidebar-open');
        })
    </script>
</body>
</html>
