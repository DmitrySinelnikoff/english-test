@extends('layouts.dashboard')

@section('title')
    Создание тега
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('tags.store') }}" method="POST" class="auth-form">
        @csrf
        <label for="word">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Добавить</button>   
        </div>
    </form>
</div> 
@endsection
