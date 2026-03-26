<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingEditRequest extends Model
{
    protected $fillable = [
        'booking_id', 'requested_by', 'approved_by',
        'field_name', 'old_value', 'new_value', 'reason', 'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
