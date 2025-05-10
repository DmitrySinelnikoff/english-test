<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'avatar' => 'mimes:png,jpg,jpeg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо заполнить поле!',
            'email.required' => 'Необходимо заполнить поле!',
            'name.max' => 'Максимальная длина 255 символов!',
            'email.max' => 'Максимальная длина 255 символов!',
            'email.email' => 'В данное поле необходимо заполнить почту!',
            'email.unique' => 'Ошибка ввода почты!',
            'avatar.mimes' => 'Можно загрузить только файлы формата: png, jpg, jpeg!',
            'avatar.max' => 'Слишком большой файл!'
        ];
    }
}
