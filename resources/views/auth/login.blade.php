@extends('layouts.dashboard')

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="auth-form" action="{{ route('login') }}">
            @csrf
            <label for="email">Почта</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><br>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"><br>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="remember-me">Запомнить меня </label>
            <div class="center-container">
                <button type="submit" class="submit-button">
                    {{ 'Войти' }}
                </button>
            </div>
            <div class="center-container">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Забыли пароль?</a>
                @endif
            </div>
            <div class="center-container">
                <a href="{{ route('register') }}">Регистрация</a>
            </div>
        </form>
    </div>
@endsection
