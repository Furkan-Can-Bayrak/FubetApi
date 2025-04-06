<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // MongoDB'yi kullanabilmek için

class Event extends Model
{
    protected $collection = 'events'; // MongoDB koleksiyonu

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'photo',
        'location',
        'published_at',
        'status', //0:pasif 1:aktif
    ];




}
