@extends('layouts.admin')
@section('title', 'Bookings')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <h2 style="font-size: 1.5rem;">All Bookings</h2>
    <form method="GET" style="display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Search reference..." value="{{ request('search') }}"
            style="padding: 0.5rem 1rem; background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 6px; color: var(--admin-text); font-size: 0.85rem;">
        <select name="status" style="padding: 0.5rem 1rem; background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 6px; color: var(--admin-text); font-size: 0.85rem;">
            <option value="">All Status</option>
            @foreach(['pending','confirmed','checked_in','checked_out','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button class="btn-admin btn-admin-primary btn-admin-sm" type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Guest</th>
                <th>Room</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td><strong>{{ $booking->booking_reference }}</strong></td>
                <td>{{ $booking->guest_info['name'] ?? ($booking->user->name ?? 'Guest') }}</td>
                <td>{{ $booking->room->name ?? 'N/A' }}</td>
                <td>{{ $booking->check_in->format('M d') }}</td>
                <td>{{ $booking->check_out->format('M d') }}</td>
                <td>₦{{ number_format($booking->total_price, 0) }}</td>
                <td><span class="badge-status badge-{{ $booking->status }}">{{ $booking->status }}</span></td>
                <td><span class="badge-status badge-{{ $booking->payment_status }}">{{ $booking->payment_status }}</span></td>
                <td>
                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="9" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No bookings found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $bookings->withQueryString()->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
