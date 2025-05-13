<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function __construct(protected CategoryService $categoryService)
    {
        parent::__construct($this->categoryService);
    }

    protected function resolveStoreRequest(): FormRequest
    {
       return app(CategoryStoreRequest::class);
    }

    protected function resolveUpdateRequest(): FormRequest
    {
        return app(CategoryUpdateRequest::class);
    }
}
