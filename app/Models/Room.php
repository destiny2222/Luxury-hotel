<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_category_id', 'name', 'slug', 'description', 'price', 
        'amenities', 'images', 'capacity', 'status'
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
