<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'guest_name', 'guest_location', 'content', 'rating', 'is_featured', 'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
