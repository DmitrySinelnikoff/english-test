@extends('layouts.dashboard')

@section('title')
    Создание тега
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('tags.store') }}" method="POST" class="auth-form" enctype="multipart/form-data">
        @csrf
        <label for="word">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <label for="word">Описание</label>
        <textarea name="description" id="description" class="form-input">{{ old('description') }}</textarea>
        @error('description')
            <div>{{ $message }}</div>
        @enderror
        <label for="image">Изображение</label>
        <input id="image" type="file" name="image" value="{{ old('image') }}">
        @error('image')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Добавить</button>   
        </div>
    </form>
</div> 
@endsection
