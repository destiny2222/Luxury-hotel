<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'room_id', 'booking_reference', 'check_in', 'check_out',
        'rooms_count', 'nights', 'subtotal', 'discount_percent', 'discount_amount',
        'total_price', 'paid_amount', 'payment_method', 'payment_status',
        'transaction_id', 'status', 'guest_info'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'guest_info' => 'array',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'discount_percent' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'SP-' . strtoupper(Str::random(8));
            }
        });
    }

    // Accessors
    public function getRoomDaysAttribute(): int
    {
        return $this->rooms_count * $this->nights;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function editRequests()
    {
        return $this->hasMany(BookingEditRequest::class);
    }

    // Discount logic
    public static function calculateDiscount(int $roomsCount, int $nights, float $pricePerNight): array
    {
        $roomDays = $roomsCount * $nights;
        $subtotal = $pricePerNight * $nights * $roomsCount;
        $discountPercent = $roomDays >= 5 ? 10 : 0;
        $discountAmount = $subtotal * ($discountPercent / 100);
        $totalPrice = $subtotal - $discountAmount;

        return [
            'room_days' => $roomDays,
            'subtotal' => round($subtotal, 2),
            'discount_percent' => $discountPercent,
            'discount_amount' => round($discountAmount, 2),
            'total_price' => round($totalPrice, 2),
        ];
    }
}
