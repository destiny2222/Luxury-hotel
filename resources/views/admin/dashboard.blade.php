@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(163,129,93,0.15); color: var(--admin-primary);">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-value">{{ $stats['total_bookings'] }}</div>
        <div class="stat-label">Total Bookings</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(245,158,11,0.15); color: var(--admin-warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-value">{{ $stats['pending_bookings'] }}</div>
        <div class="stat-label">Pending Bookings</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(34,197,94,0.15); color: var(--admin-success);">
            <i class="fas fa-naira-sign"></i>
        </div>
        <div class="stat-value">₦{{ number_format($stats['total_revenue'], 0) }}</div>
        <div class="stat-label">Total Revenue</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(59,130,246,0.15); color: var(--admin-info);">
            <i class="fas fa-bed"></i>
        </div>
        <div class="stat-value">{{ $stats['available_rooms'] }}/{{ $stats['total_rooms'] }}</div>
        <div class="stat-label">Available Rooms</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(139,92,246,0.15); color: #8b5cf6;">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Registered Users</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(239,68,68,0.15); color: var(--admin-danger);">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-value">{{ $stats['unread_messages'] }}</div>
        <div class="stat-label">Unread Messages</div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="admin-table-card">
    <div class="admin-table-header">
        <h3>Recent Bookings</h3>
        <a href="{{ route('admin.bookings.index') }}" class="btn-admin btn-admin-outline btn-admin-sm">View All</a>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Guest</th>
                <th>Room</th>
                <th>Check In</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentBookings as $booking)
            <tr>
                <td><strong>{{ $booking->booking_reference }}</strong></td>
                <td>{{ $booking->guest_info['name'] ?? ($booking->user->name ?? 'Guest') }}</td>
                <td>{{ $booking->room->name ?? 'N/A' }}</td>
                <td>{{ $booking->check_in->format('M d, Y') }}</td>
                <td>₦{{ number_format($booking->total_price, 0) }}</td>
                <td><span class="badge-status badge-{{ $booking->status }}">{{ $booking->status }}</span></td>
                <td><span class="badge-status badge-{{ $booking->payment_status }}">{{ $booking->payment_status }}</span></td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No bookings yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
