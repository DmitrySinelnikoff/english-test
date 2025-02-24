@extends('layouts.dashboard')

@section('title')
    Регистрация
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="authForm" action="{{ route('register') }}">
            @csrf
            <label for="name">Имя</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            <label for="email">Почта</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">

            <label for="password-confirm">Подтвердите пароль</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            <div class="centerContainer">
                <button type="submit" class="submitButton">Регистрация</button>
            </div>
            <div class="centerContainer">
                <a href="{{ route('login') }}">Авторизация</a>
            </div>
        </form>
    </div>
@endsection
