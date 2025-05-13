<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;

class CategoryService extends BaseService
{

    public function __construct(protected CategoryRepository $categoryRepository)
    {
        parent::__construct($this->categoryRepository);

    }

}
