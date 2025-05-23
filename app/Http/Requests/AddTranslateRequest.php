<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTranslateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'translate_id' => 'required',
            'english_id' => 'required',
            'part_of_speech_id' => 'required',
            'picture' => 'mimes:png,jpg,jpeg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'translate_id.required' => 'Необходимо заполнить поле "Перевод"',
            'part_of_speech_id.required' => 'Необходимо заполнить поле "Часть речи"',
            'picture.mimes' => 'Можно загрузить только файлы формата: png, jpg, jpeg!',
            'picture.max' => 'Слишком большой файл!'
        ];
    }
}
