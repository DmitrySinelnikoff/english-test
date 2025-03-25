<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name.required' => 'Необходимо заполнить поле!',
            'email.required' => 'Необходимо заполнить поле!',
            'password.required' => 'Необходимо заполнить поле!',
            'name.max' => 'Максимальная длина 255 символов!',
            'email.max' => 'Максимальная длина 255 символов!',
            'password.min' => 'Минимальная длина пароля 8 символов!',
            'email.email' => 'В данное поле необходимо заполнить почту!',
            'email.unique' => 'Ошибка ввода почты!',
            'password.confirmed' => 'Пароли не совпадают!'
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_role_id' => 1
        ]);
    }
}
