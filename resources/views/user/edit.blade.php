@extends('layouts.dashboard')

@section('title')
    Изменение
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="auth-form" action="{{ route('user.update') }}" enctype="multipart/form-data">
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

            <label for="avatar">Аватар</label>
            <div class="center-container">
                <label>Текущий:</label>
                <img src="{{ asset('img/avatars/' . ($user->image_path ?? 'unknown_avatar.jpg')) }}" alt="Аватар не найден" class="avatar-img-edit" width="100px" height="100px">
            </div>
            <input id="avatar" type="file" name="avatar" value="{{ old('avatar') }}">
            @error('avatar')
                <div>{{ $message }}</div>
            @enderror

            <div class="center-container">
                <button type="submit" class="submit-button">Изменение</button>
            </div>
        </form>
    </div>
@endsection
