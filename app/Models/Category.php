<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // MongoDB'yi kullanabilmek için


class Category extends Model
{
    protected $collection = 'categories'; // MongoDB koleksiyonu

    protected $fillable = [
        'name',
    ];

}
