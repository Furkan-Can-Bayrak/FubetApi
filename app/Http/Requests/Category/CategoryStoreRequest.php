<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends CategoryRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }

    public function attributes() : array
    {
        $attr = parent::attributes();
        return $attr;
    }

}
