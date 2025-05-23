<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'required|string',
            'transcription' => 'required|string',
            'tag_ids' => 'required|array',
            'tag_ids*' => 'integer|exists:tags,id'
        ];
    }

    public function messages()
    {
        return [
            'word.required' => 'Необходимо заполнить поле "Слово"',
            'word.string' => 'Слово не должно содержать цифр',
            'transcription.required' => 'Необходимо заполнить поле "Транскрипция"',
            'transcription.string' => 'Слово не должно содержать цифр',
            'tag_ids.required' => 'Необходимо заполнить поле "Тег"'
        ];
    }
}
