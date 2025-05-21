<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле необходимо заполнить',
            'description.required' => 'Это поле необходимо заполнить',
            'image.mimes' => 'Можно загрузить только файлы формата: png, jpg, jpeg!',
            'image.max' => 'Слишком большой файл!'
        ];
    }
}
