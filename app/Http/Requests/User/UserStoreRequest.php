<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends UserRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }
}
