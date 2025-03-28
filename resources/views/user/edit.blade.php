@extends('layouts.dashboard')

@section('title')
    Изменение
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="auth-form" action="{{ route('user.update') }}">
            @csrf
            @method('PATCH')
            <label for="name">Имя</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror

            <label for="email">Почта</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror

            <div class="center-container">
                <button type="submit" class="submit-button">Изменение</button>
            </div>
        </form>
    </div>
@endsection
