<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends UserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = 'required|email|unique:users,email,' . $this->route('id');
        $rules['student_number'] = 'required|string|size:9|unique:users,student_number' . $this->route('id');
        return $rules;
    }
}
