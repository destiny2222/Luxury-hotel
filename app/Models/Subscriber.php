<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'token', 'verified_at'];

    protected static function booted()
    {
        static::creating(function ($subscriber) {
            $subscriber->token = bin2hex(random_bytes(32));
        });
    }
}
