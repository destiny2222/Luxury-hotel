@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>My Bookings</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">My Bookings</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 900px;">
        @forelse($bookings as $booking)
        <div style="background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 1.5rem; border-left: 4px solid {{ $booking->status === 'confirmed' ? '#28a745' : ($booking->status === 'cancelled' ? '#dc3545' : '#f59e0b') }};">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                        <h3 style="font-size: 1.3rem; margin: 0;">{{ $booking->room->name ?? 'Room' }}</h3>
                        <span style="padding: 0.2rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize;
                            background: {{ $booking->status === 'confirmed' ? '#d4edda' : ($booking->status === 'cancelled' ? '#f8d7da' : '#fff3cd') }};
                            color: {{ $booking->status === 'confirmed' ? '#155724' : ($booking->status === 'cancelled' ? '#721c24' : '#856404') }};">
                            {{ $booking->status }}
                        </span>
                    </div>
                    <p style="color: #666; font-size: 0.9rem;">
                        <i class="fas fa-hashtag"></i> {{ $booking->booking_reference }} &nbsp;|&nbsp;
                        <i class="far fa-calendar"></i> {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }} &nbsp;|&nbsp;
                        <i class="fas fa-moon"></i> {{ $booking->nights }} night(s), {{ $booking->rooms_count }} room(s)
                    </p>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 1.3rem; font-weight: 700; color: var(--color-primary);">₦{{ number_format($booking->total_price, 0) }}</div>
                    <div style="font-size: 0.8rem; color: #666; text-transform: capitalize;">{{ str_replace('_', ' ', $booking->payment_status) }}</div>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 4rem; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <i class="fas fa-calendar-times" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
            <h3>No bookings yet</h3>
            <p style="color: #666; margin-bottom: 2rem;">You haven't made any reservations yet.</p>
            <a href="{{ route('rooms.index') }}" class="btn btn-primary">Browse Rooms</a>
        </div>
        @endforelse

        <div style="display: flex; justify-content: center; margin-top: 2rem;">
            {{ $bookings->links() }}
        </div>
    </div>
</section>
@endsection
