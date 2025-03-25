<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'required|string|unique:english_words,word',
            'transcription' => 'required|string',
            'tag_ids' => 'required|array',
            'tag_ids*' => 'integer|exists:tags,id',
            'translate_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'word.required' => 'Необходимо заполнить поле "Слово"',
            'word.string' => 'Слово не должно содержать цифр',
            'word.unique' => 'Такое слово уже существует',
            'transcription.required' => 'Необходимо заполнить поле "Транскрипция"',
            'transcription.string' => 'Слово не должно содержать цифр',
            'tag_ids.required' => 'Необходимо заполнить поле "Тег"',
            'translate_id.required' => 'Необходимо заполнить поле "Перевод"',
        ];
    }
}
