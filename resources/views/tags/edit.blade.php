@extends('layouts.dashboard')

@section('title')
    Тег - {{ $tag->name }}
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('tags.update', $tag) }}" method="POST" class="auth-form" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="word">Название</label>
        <input type="text" name="name" id="name" value="{{ $tag->name }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <label for="word">Описание</label>
        <textarea name="description" id="description" class="form-input">{{ $tag->description }}</textarea>
        @error('description')
            <div>{{ $message }}</div>
        @enderror
        <label for="image">Изображение</label>
        <div class="center-container">
            <label>Текущее:</label>
            <img src="{{ asset('img/tags/' . ($tag->image_path ?? 'word-pattern.jpg')) }}" alt="Аватар не найден" class="avatar-img-edit" width="100px" height="100px">
        </div>
        <input id="image" type="file" name="image" value="{{ old('image') }}">
        @error('image')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Изменить</button>   
        </div>
    </form>
</div> 
@endsection
