<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role helpers
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    public function isFrontDesk(): bool
    {
        return $this->role === 'front_desk';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'supervisor', 'front_desk']);
    }

    public function canApproveEdits(): bool
    {
        return in_array($this->role, ['super_admin', 'supervisor']);
    }

    public function canDelete(): bool
    {
        return in_array($this->role, ['super_admin', 'supervisor']);
    }

    public function canExport(): bool
    {
        return in_array($this->role, ['super_admin', 'supervisor']);
    }

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
