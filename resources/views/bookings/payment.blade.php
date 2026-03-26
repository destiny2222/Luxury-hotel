@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Complete Payment</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Payment</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px;">
        <div style="background: #fff; padding: 3rem; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">

            <!-- Booking Summary -->
            <h2 style="text-align: center; margin-bottom: 0.5rem;">Payment Summary</h2>
            <p style="text-align: center; color: #666; margin-bottom: 2rem;">Booking Reference: <strong>{{ $booking->booking_reference }}</strong></p>

            <div style="background: #f9f9f9; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: #666;">Room</span>
                    <strong>{{ $booking->room->name }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: #666;">Check In</span>
                    <span>{{ $booking->check_in->format('M d, Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: #666;">Check Out</span>
                    <span>{{ $booking->check_out->format('M d, Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: #666;">Rooms × Nights</span>
                    <span>{{ $booking->rooms_count }} × {{ $booking->nights }}</span>
                </div>
                @if($booking->discount_percent > 0)
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; color: #28a745;">
                    <span>Discount ({{ $booking->discount_percent }}%)</span>
                    <span>-₦{{ number_format($booking->discount_amount, 2) }}</span>
                </div>
                @endif
                <div style="display: flex; justify-content: space-between; padding-top: 0.75rem; border-top: 1px solid #ddd;">
                    <span style="color: #666;">Booking Total</span>
                    <strong>₦{{ number_format($booking->total_price, 2) }}</strong>
                </div>
            </div>

            <!-- Payment Details -->
            <div style="background: linear-gradient(135deg, #A3815D 0%, #8c6e4d 100%); color: #fff; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <p style="font-size: 0.85rem; opacity: 0.9; margin-bottom: 0.25rem; text-transform: uppercase; letter-spacing: 1px;">
                    {{ $booking->payment_method === 'deposit_50' ? '50% Reservation Deposit' : 'Full Payment' }}
                </p>
                <div style="font-size: 2.2rem; font-weight: 700;">₦{{ number_format($chargeAmount, 2) }}</div>
                @if($booking->payment_method === 'deposit_50')
                    <p style="font-size: 0.85rem; opacity: 0.8; margin-top: 0.5rem;">
                        Remaining ₦{{ number_format($booking->total_price - $chargeAmount, 2) }} due at check-in
                    </p>
                @endif
            </div>

            <!-- Pay Button -->
            <button id="payBtn" onclick="makePayment()"
                style="width: 100%; padding: 1.2rem; font-size: 1.1rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border: none; cursor: pointer; border-radius: 8px; background: var(--color-primary, #A3815D); color: #fff; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="fas fa-lock"></i> Pay ₦{{ number_format($chargeAmount, 2) }} with Flutterwave
            </button>

            <p style="text-align: center; margin-top: 1.5rem; font-size: 0.8rem; color: #999;">
                <i class="fas fa-shield-alt"></i> Secured by Flutterwave. Your payment information is encrypted.
            </p>

            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('booking.success', $booking->booking_reference) }}" style="color: #666; font-size: 0.85rem; text-decoration: underline;">
                    Pay later at the hotel instead
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
function makePayment() {
    const btn = document.getElementById('payBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Initiating Payment...';

    FlutterwaveCheckout({
        public_key: "{{ $publicKey }}",
        tx_ref: "{{ $booking->booking_reference }}",
        amount: {{ $chargeAmount }},
        currency: "NGN",
        payment_options: "card, mobilemoney, ussd, banktransfer",
        customer: {
            email: "{{ $booking->guest_info['email'] }}",
            phone_number: "{{ $booking->guest_info['phone'] }}",
            name: "{{ $booking->guest_info['name'] }}",
        },
        customizations: {
            title: "Sea Pearl Resort",
            description: "Booking #{{ $booking->booking_reference }}",
            logo: "",
        },
        callback: function(data) {
            // Payment completed, redirect to callback for server-side verification
            window.location.href = "{{ route('booking.callback') }}?transaction_id=" + data.transaction_id + "&tx_ref=" + data.tx_ref;
        },
        onclose: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-lock"></i> Pay ₦{{ number_format($chargeAmount, 2) }} with Flutterwave';
        },
    });
}
</script>
@endsection
