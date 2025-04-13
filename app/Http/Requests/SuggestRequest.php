<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'word' => 'required|string|unique:english_words,word',
            'transcription' => 'required|string',
            'tag_ids' => 'required|array',
            'tag_ids*' => 'integer|exists:tags,id',
            'translate_id' => 'required',
            'part_of_speech_id' => 'required'
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
            'part_of_speech_id.required' => 'Необходимо заполнить поле "Часть речи"',
        ];
    }
}
