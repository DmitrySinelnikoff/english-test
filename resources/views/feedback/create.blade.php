@extends('layouts.dashboard')

@section('title')
    Обратная связь
@endsection

@section('content')
<div class="substrate">
    <h1 class="center-container">Обратная связь</h1>
    <form action="{{ route('feedback.store') }}" method="post" class="auth-form">
        @csrf
        <label for="Message">Текст</label>
        <textarea name="message" id="message" class="form-input"></textarea>
        @error('message')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Отправить</button>   
        </div>
    </form>
</div>
@if(auth()->check() && auth()->user()->user_role_id == 2)
<div class="substrate">
    <div class="center-container">
        <a href="{{ route('feedback.index') }}" class="submit-button">Все записи</a>
    </div>
</div>
@endif
@endsection
