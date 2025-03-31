<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RussianWordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'required|string|unique:russian_words,word'
        ];
    }

    public function messages()
    {
        return [
            'word.required' => 'Необходимо заполнить поле "Слово"',
            'word.string' => 'Слово не должно содержать цифр',
            'word.unique' => 'Такое слово уже существует'
        ];
    }
}
