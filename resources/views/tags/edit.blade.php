@extends('layouts.dashboard')

@section('title')
    Тег - {{ $tag->name }}
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('tags.update', $tag) }}" method="POST" class="auth-form">
        @csrf
        @method('PATCH')
        <label for="word">Название</label>
        <input type="text" name="name" id="name" value="{{ $tag->name }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Изменить</button>   
        </div>
    </form>
</div> 
@endsection
