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
            <a href="{{ route('main.index') }}">Английский</a>
        </div>
        <div class="center-container">
            <form method="POST" action="{{ route('search.index')}}" class="search-form" onsubmit="return validateSearch()">
                @csrf
                <input type="text" name="search" value="{{ old('name') }}" class="search-input" id="searchText">
                <input type="submit" value="🔍" class="search-button">
            </form>
        </div>
        <div class="dashboard-header-nav">
            @auth
            <div class="dashboard-header-logo" id="accaunt">
                <a href="{{ route('user.show', ['user' => Auth::user()]) }}">Аккаунт</a>
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
                <a href="{{ route('login') }}">Войти</a>
            </div>
            @endguest
        </div>
    </header>
    <div class="dashboard-sidebar">
        <a href="{{ route('main.index') }}" class="dashboard-button">Главная</a>
        <a href="{{ route('word.index') }}" class="dashboard-button">Слова</a>
        <a href="{{ route('tags.index') }}" class="dashboard-button">Категории тестов</a>
        <a href="{{ route('wordtest.list') }}" class="dashboard-button">Ваши тесты</a>
        <a href="{{ route('user.index') }}" class="dashboard-button">Пользователи</a>
        @auth
            <a href="{{ route('suggest.create') }}" class="dashboard-button">Предложить слово</a>
        @endauth
        @if(auth()->check() && Auth::user()->user_role_id == 2)
            <a href="{{ route('suggest.index') }}" class="dashboard-button">Предложенные слова</a>
        @endif
    </div>
    <div class="dashboard-body">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            tags: true
        })

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

        // $('.select2').select2({
        //     ajax: {
        //         url: 'https://api.github.com/search/repositories',
        //         dataType: 'json'
        //     }
        // });
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
            }
    </script>
</body>
</html>
