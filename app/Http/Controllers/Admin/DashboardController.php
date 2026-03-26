<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\BookingEditRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'unread_messages' => ContactMessage::where('status', 'unread')->count(),
            'pending_edits' => BookingEditRequest::where('status', 'pending')->count(),
        ];

        $recentBookings = Booking::with(['room', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
