@extends('layouts.dashboard')

@section('title')
    Статистика
@endsection

@section('content')
<div class="substrate">
    <h1>Люди</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во людей: {{ $data['peopleCount'] }}</div>
        <div class="statistic-card">Кол-во людей: {{ $data['usersCount'] }}</div>
        <div class="statistic-card">Кол-во администраторов: {{ $data['adminCount'] }}</div>
        <div class="statistic-card">Кол-во людей зарегестированных сегодня: {{ $data['registeredPeopleCount'] }}</div>
    </div>
</div>
<div class="substrate">
    <h1>Слова английские</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во слов: {{ $data['englishWordsCount'] }}</div>
        <div class="statistic-card">Кол-во предложенных слов: {{ $data['suggestedEnglishWordsCount'] }}</div>
        <div class="statistic-card">Кол-во добавленных слов за день: {{ $data['createTodayEnglishWordsCount'] }}</div>
    </div>
</div>
<div class="substrate">
    <h1>Слова русские</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во слов: {{ $data['russianWordsCount'] }}</div>
        <div class="statistic-card">Кол-во добавленных слов за день: {{ $data['createTodayRussianWordsCount'] }}</div>
    </div>
</div>
<div class="substrate">
    <h1>Категории</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во категорий: {{ $data['tagsCount'] }}</div>
    </div>
</div>
<div class="substrate">
    <h1>Просмотры</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во просмотров слов: {{ $data['viewsCount'] }}</div>
        <div class="statistic-card">Кол-во просмотров слов за день: {{ $data['todayViewsCount'] }}</div>
    </div>
</div>
@endsection
