@extends('layouts.dashboard')

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="authForm" action="{{ route('login') }}">
            @csrf
            <label for="email">Почта</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><br>

            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"><br>

            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="rememberMe">Запомнить меня </label>
            <div class="centerContainer">
                <button type="submit" class="submitButton">
                    {{ 'Войти' }}
                </button>
            </div>
            {{-- <div class="centerContainer">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ 'Забыли пароль?' }}
                    </a>
                @endif
            </div> --}}
            <div class="centerContainer">
                <a href="{{ route('register') }}">Регистрация</a>
            </div>
        </form>
    </div>
@endsection
