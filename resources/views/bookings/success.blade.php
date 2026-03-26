@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Booking Confirmed</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Booking Success</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px;">
        <div style="background: #fff; padding: 3rem; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 80px; height: 80px; background: #d4edda; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-check" style="font-size: 2rem; color: #28a745;"></i>
            </div>
            <h2 style="margin-bottom: 0.5rem;">Thank You!</h2>
            <p style="color: #666; margin-bottom: 2rem;">Your booking has been received and is being processed.</p>

            <div style="background: #f9f9f9; padding: 1.5rem; border-radius: 8px; text-align: left; margin-bottom: 2rem;">
                <div style="display: grid; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Reference</span>
                        <strong>{{ $booking->booking_reference }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Room</span>
                        <span>{{ $booking->room->name }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Check In</span>
                        <span>{{ $booking->check_in->format('M d, Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Check Out</span>
                        <span>{{ $booking->check_out->format('M d, Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Rooms × Nights</span>
                        <span>{{ $booking->rooms_count }} × {{ $booking->nights }}</span>
                    </div>
                    @if($booking->discount_percent > 0)
                    <div style="display: flex; justify-content: space-between; color: #28a745;">
                        <span>Discount ({{ $booking->discount_percent }}%)</span>
                        <span>-₦{{ number_format($booking->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    <div style="display: flex; justify-content: space-between; font-weight: 700; padding-top: 0.5rem; border-top: 1px solid #ddd;">
                        <span>Total</span>
                        <span>₦{{ number_format($booking->total_price, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #666;">Amount Paid</span>
                        <span style="text-transform: capitalize;">₦{{ number_format($booking->paid_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <p style="color: #28a745; margin-bottom: 1rem;">{{ session('success') }}</p>
            @endif
            @if(session('warning'))
                <p style="color: #f59e0b; margin-bottom: 1rem;">{{ session('warning') }}</p>
            @endif

            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</section>
@endsection
