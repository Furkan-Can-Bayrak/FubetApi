<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // MongoDB'yi kullanabilmek için


class EventApplication extends Model
{
    protected $collection = 'event_applications'; // MongoDB koleksiyonu

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'updated_by_user_id', //güncelleyen kişi id
        'rejection_reason', // reddetme sebebi
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
