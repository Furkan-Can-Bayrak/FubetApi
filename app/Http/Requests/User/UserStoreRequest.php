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

    /**
     * Override the validated method to process data after validation.
     *
     * @param  string|array|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        $validatedData = parent::validated($key, $default);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        return $validatedData;
    }
}
