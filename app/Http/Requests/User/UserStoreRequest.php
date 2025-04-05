<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends UserRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['password'] ='required|string|confirmed';
        return $rules;
    }

    public function attributes() : array
    {
        $attr = parent::attributes();
        $attr['password'] = 'şifre';
        return $attr;
    }
}
