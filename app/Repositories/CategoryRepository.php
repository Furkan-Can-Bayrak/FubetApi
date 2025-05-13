<?php

namespace App\Repositories;



use App\Models\Event;

class CategoryRepository extends BaseRepository
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }
}
