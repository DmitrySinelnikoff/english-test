@extends('layouts.main')

@section('title')
    Главная
@endsection

@section('content')
<div class="about-card">
    <div class="about-card-text">
        Английский легко с WordExamTest!
    </div>
    <div class="about-button-container">
        <a href="{{ route('register') }}" class="about-card-button">
            Регистрация
        </a>
        <a href="{{ route('login') }}" class="about-card-button">
            Начать
        </a>
    </div>
</div>
@endsection
