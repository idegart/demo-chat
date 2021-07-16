<?php

namespace App\Http\Requests\Authentication;

use App\Contracts\Authentication\LoginUserData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements LoginUserData
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    public function login(): string
    {
        return $this->input('email');
    }

    public function password(): string
    {
        return $this->input('password');
    }
}
