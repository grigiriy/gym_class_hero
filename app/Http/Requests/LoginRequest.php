<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        // Подставьте вашу логику для определения, может ли этот запрос быть инициирован пользователем.
        // Обычно если это форма входа, любой может ее инициировать, поэтому возвращается true.
        return true; 
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            // Другие возможные правила валидации
        ];
    }

    // Здесь, при необходимости, могут быть добавлены кастомные сообщения об ошибках или проверки валидации.
}