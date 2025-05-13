<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

abstract class CategoryRequest extends FormRequest
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
            'name' => 'Kategori adı',
        ];
    }
}
