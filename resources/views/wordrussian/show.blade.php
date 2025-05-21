@extends('layouts.dashboard')

@section('title')
    Слово - {{ $word->word }}
@endsection

@section('content')
    <div class="word-head-big">
        <div class="center-container">
            {{ $word->word }}
        </div>
    </div>
    @if(auth()->check() && auth()->user()->user_role_id == 2)
        <div class="substrate">
            <div class="center-container small-gap">
                <form action="{{ route('russian.word.delete', $word) }}" method="post" class="button-form" onsubmit="return validateDelete()">
                    @csrf
                    @method('delete')
                    <button type="submit" class="submit-button">
                        Удалить
                    </button>
                </form>
                <form action="{{ route('russian.word.edit', $word) }}" method="get" class="button-form">
                    @csrf
                    <button type="submit" class="submit-button">
                       Изменить 
                    </button>
                </form>
            </div>
        </div>
    @endif
    <div class="substrate">
        <h1>Перевод</h1>
        <div class="scroll-container" id="scroll-bad-translate">
            @foreach ($word->original as $translate)
                <a href="{{ route('word.show', $translate) }}" class="card-gray">{{ $translate->word }}</a>
            @endforeach
        </div>
    </div>
    <script>
        function validateDelete() {
            if(confirm('Вы хотите удалить это слово?')) {
                return true
            } else {
                return false
            }
        }

        function checkAndUpdateContent(element) {
            let content = element.innerHTML;
            if (content.trim() === '') element.innerHTML = 'Данные не найдены';
        }
        checkAndUpdateContent(document.getElementById('scroll-bad-translate'));
    </script>
@endsection