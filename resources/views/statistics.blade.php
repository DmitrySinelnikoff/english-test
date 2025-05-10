@extends('layouts.dashboard')

@section('title')
    Статистика
@endsection

@section('content')
<div class="substrate">
    <h1 class="">Категории</h1>
    <div class="scroll-container">
        @foreach ($tags as $tag)
        <a href="{{ route('tags.show', ['tag' => $tag]) }}">
            @if ($tag->words->count() > 0)
                <div class="card-gray">
                    <div>{{ $tag->name }}</div>
                    <div>{{ $tag->words_count }}</div>
                </div>
            @endif
        </a>
        @endforeach
    </div>
</div>
<div class="substrate">
    <h1 class="">Популярные слова</h1>
    <div class="scroll-container">
        @foreach ($views as $view)
        <a href="{{ route('word.show', ['word' => $view]) }}">
            <div class="card-gray">
                <div>{{ $view->word }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@auth
    @if($viewed->count())
        <div class="substrate">
            <h1 class="">Ваши просмотры</h1>
            <div class="scroll-container">
                @foreach ($viewed as $view)
                <a href="{{ route('word.show', ['word' => $view]) }}">
                    <div class="card-gray">
                        <div>{{ $view->word }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    @endif
@endauth
<div class="substrate">
    <h1>Люди</h1>
    <div class="statistic-card-container">
        <div class="statistic-card">Кол-во людей: {{ $data['peopleCount'] }}</div>
        <div class="statistic-card">Кол-во пользователей: {{ $data['usersCount'] }}</div>
        <div class="statistic-card">Кол-во администраторов: {{ $data['adminCount'] }}</div>
        <div class="statistic-card">Кол-во людей зарегистированных сегодня: {{ $data['registeredPeopleCount'] }}</div>
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
