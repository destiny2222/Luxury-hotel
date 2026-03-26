<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
