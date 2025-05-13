<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends CategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }
}
