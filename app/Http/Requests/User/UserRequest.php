<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

abstract class UserRequest extends FormRequest
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
            'student_number' => 'required|string|size:9',
            'phone' => 'required|string|regex:/^05\d{9}$/',
            'email' => 'required|email|ends_with:@firat.edu.tr|unique:users,email',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'class' => 'required|integer|between:1,6',
            'birth_date' => 'required|date|before:today',
        ];
    }

    /**
     * Özel attribute isimlerini tanımlar.
     *
     * @return array
     */
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
        ];
    }
}
