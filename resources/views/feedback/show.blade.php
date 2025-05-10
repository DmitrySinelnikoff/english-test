@extends('layouts.dashboard')

@section('title')
    Обратная связь
@endsection

@section('content')
    <div class="substrate">
        <h1>Пользователь: {{ App\Models\User::where('id', $feedback->user_id)->first()->name }}</h1>
    </div>
    <div class="substrate">
        <h1>Сообщение:</h1>
        <textarea class="textarea-card">{{ $feedback->text }}</textarea>
    </div>
    <div class="substrate">
        <div class="center-container">
            <form action="{{ route('feedback.delete', $feedback) }}" method="post" class="button-form" onsubmit="return validateDelete()">
                @csrf
                @method('delete')
                <button type="submit" class="submit-button">
                    Удалить
                </button>
            </form>
        </div>
    </div>
    <div class="substrate">
        <h1>Создание: {{ $feedback->created_at ?? 'Нет данных' }}</h1>
    </div>
    <script>
        function validateDelete() {
            if(confirm('Вы хотите удалить этот отзыв?')) {
                return true
            } else {
                return false
            }
        }
    </script>
@endsection