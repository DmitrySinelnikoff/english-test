@extends('layouts.dashboard')

@section('title')
    Обратная связь
@endsection

@section('content')
    @if($feedbacks->count() == 0)
        <div class="substrate" style="margin-top: 20%">
            <div class="center-container">
                <h1>Данные не найдены</h1>
            </div>
        </div>
    @else
        @foreach ($feedbacks as $feedback)
            <div class="word-container">
                <a href="{{ route('feedback.show', ['feedback' => $feedback]) }}">
                    <div class="word-card">
                        <span>
                            {{ App\Models\User::where('id', $feedback->user_id)->first()->name }}
                        </span>
                        <br>
                        <textarea name="text" id="text" class="textarea-card">{{ $feedback->text }}</textarea>
                    </div>
                </a>
            </div>
        @endforeach
        <div>
            {{ $feedbacks->links('pagination::bootstrap-4') }}
        </div>
        @if(auth()->check() && Auth::user()->user_role_id == 2)
            <a class="add-button" href="{{ route('feedback.create') }}">+</a>
        @endif
    @endif
@endsection
