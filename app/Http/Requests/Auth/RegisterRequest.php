<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:50',
            'student_number' => 'required|string|size:9|unique:users,student_number',
            'phone' => 'required|string|regex:/^05\d{9}$/',
            'email' => 'required|email|ends_with:@firat.edu.tr|unique:users,email',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'class' => 'required|integer|between:1,6',
            'birth_date' => 'required|date|before:today',
            'password' => 'required|string|confirmed',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'isim',
            'surname' => 'soyisim',
            'student_number' => 'öğrenci numarası',
            'phone' => 'telefon numarası',
            'email' => 'e-posta adresi',
            'faculty' => 'fakülte',
            'department' => 'bölüm',
            'class' => 'sınıf',
            'birth_date' => 'doğum tarihi',
            'password' => 'şifre',
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validatedData = parent::validated($key, $default);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        return $validatedData;
    }

}
