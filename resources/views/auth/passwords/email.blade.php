@extends('layouts.dashboard')

@section('title')
    Восстановление пароля
@endsection

@section('content')
<div class="substrate">
    <div class="center-container">
        <h1>Восстановление пароля</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <label>Почта</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div role="alert">{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Восстановление</button>
        </div>
    </form>

</div>
@endsection
