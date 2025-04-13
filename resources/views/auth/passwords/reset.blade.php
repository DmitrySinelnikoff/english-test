@extends('layouts.dashboard')

@section('title')
    Восстановление пароля
@endsection

@section('content')
<div class="substrate">
    <div class="center-container">
        <h1>Восстановление пароля</h1=>
    </div>
    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email" class="col-md-4 col-form-label text-md-end">Почта</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
        <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <div>{{ $message }}</в>
        @enderror
        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтверждение пароля</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <div class="center-container">
            <button type="submit" class="submit-button">Восстановление</button>
        </div>
    </form>
</div>
@endsection
