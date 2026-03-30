@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('{{ !empty($room->images[0]) ? (str_starts_with($room->images[0], 'http') ? $room->images[0] : asset('uploads/rooms/' . $room->images[0])) : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}'); min-height: 300px;">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>{{ $room->name }}</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('rooms.index') }}">Rooms</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">{{ $room->name }}</span>
        </div>
    </div>
</section>

<section class="room-details-page section-padding">
    <div class="container">
        <div class="room-layout">
            <div class="room-main">
                <div class="room-gallery">
                    <div class="main-image">
                        <img id="mainRoomImage" src="{{ !empty($room->images[0]) ? (str_starts_with($room->images[0], 'http') ? $room->images[0] : asset('uploads/rooms/' . $room->images[0])) : 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $room->name }}">
                    </div>
                    <div class="thumbnail-grid">
                        @foreach($room->images as $index => $image)
                            <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="swapImage(this, '{{ $image }}')">
                                <img src="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset('uploads/rooms/' . $image)) : 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $room->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="room-info">
                    <span class="category">{{ $room->category->name }}</span>
                    <h1>{{ $room->name }}</h1>
                    
                    <div class="room-meta">
                        <span>Price: <strong>₦{{ number_format($room->price, 2) }}</strong> / Night</span>
                        <span>Capacity: <strong>{{ $room->capacity }} Person(s)</strong></span>
                    </div>

                    <div class="room-description">
                        <h3>Description</h3>
                        <p>{{ $room->description }}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="room-amenities-detailed">
                        <h3>Amenities</h3>
                        <div class="amenities-grid">
                            @foreach($room->amenities as $amenity)
                                <div class="amenity-item">
                                    <span class="check">✓</span> {{ $amenity }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="room-sidebar">
                <div class="booking-card">
                    <h3>Book This Room</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="form-group">
                            <label>Check In</label>
                            <input type="date" name="check_in" id="check_in" value="{{ old('check_in', date('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Check Out</label>
                            <input type="date" name="check_out" id="check_out" value="{{ old('check_out', date('Y-m-d', strtotime('+1 day'))) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Number of Rooms</label>
                            <select name="rooms_count" id="rooms_count">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }} Room{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Live Price Preview -->
                        <div id="pricePreview" style="background: #f9f9f9; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: #666; font-size: 0.9rem;">₦{{ $room->price }} × <span id="previewNights">1</span> night(s) × <span id="previewRooms">1</span> room(s)</span>
                            </div>
                            <div id="subtotalRow" style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                                <span style="color: #666;">Subtotal</span>
                                <span id="previewSubtotal">₦{{ number_format($room->price, 2) }}</span>
                            </div>
                            <div id="discountRow" style="display: none; color: #28a745; justify-content: space-between; margin-bottom: 0.3rem;">
                                <span>🎉 10% Discount</span>
                                <span id="previewDiscount">₦0.00</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-weight: 700; border-top: 1px dashed #ddd; padding-top: 0.5rem; margin-top: 0.5rem;">
                                <span>Total</span>
                                <span id="previewTotal" style="color: var(--color-primary); font-size: 1.1rem;">₦{{ number_format($room->price, 2) }}</span>
                            </div>
                            <div id="discountHint" style="display: none; margin-top: 0.5rem; padding: 0.5rem; background: #d4edda; color: #155724; border-radius: 4px; font-size: 0.8rem; text-align: center;">
                                🎉 10% Room-Day discount applied! (5+ room-days)
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="font-size: 20px;font-weight:800;">Payment Method</label>
                            <select name="payment_method" id="payment_method">
                                <option value="pay_at_hotel">Pay at Hotel</option>
                                <option value="full">Full Payment Online</option>
                                <option value="deposit_50">50% Deposit</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="guest_name" value="{{ old('guest_name', auth()->user()->name ?? '') }}" placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="guest_email" value="{{ old('guest_email', auth()->user()->email ?? '') }}" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="guest_phone" value="{{ old('guest_phone', auth()->user()->phone ?? '') }}" placeholder="Enter your phone" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-full">Reserve Now</button>
                    </form>
                </div>

                <div class="related-rooms-sidebar">
                    <h3>Related Rooms</h3>
                    @foreach($relatedRooms as $related)
                        <div class="related-item">
                            <div class="related-img">
                                <img src="{{ !empty($related->images[0]) ? (str_starts_with($related->images[0], 'http') ? $related->images[0] : asset('uploads/rooms/' . $related->images[0])) : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" alt="{{ $related->name }}">
                            </div>
                            <div class="related-info">
                                <h4><a href="{{ route('rooms.show', $related->slug) }}">{{ $related->name }}</a></h4>
                                <span class="price">₦{{ number_format($related->price, 2) }} / Night</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .room-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
    }

    .room-gallery {
        margin-bottom: 3rem;
    }

    .main-image {
        height: 500px;
        margin-bottom: 1rem;
        border-radius: 8px;
        overflow: hidden;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .thumbnail {
        height: 100px;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.7;
        transition: var(--transition);
    }

    .thumbnail:hover,
    .thumbnail.active {
        opacity: 1;
        border: 2px solid var(--primary-color);
    }

    .room-info .category {
        color: var(--primary-color);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .room-info h1 {
        font-size: 3.5rem;
        margin: 0.5rem 0 1.5rem;
    }

    .room-meta {
        display: flex;
        gap: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .room-meta strong {
        color: var(--secondary-color);
    }

    .room-description h3, .room-amenities-detailed h3 {
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    .room-description p {
        margin-bottom: 1.5rem;
        color: var(--text-muted);
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .amenity-item {
        color: var(--text-muted);
    }

    .amenity-item .check {
        color: var(--primary-color);
        margin-right: 0.5rem;
        font-weight: 700;
    }

    /* Sidebar */
    .booking-card {
        background-color: var(--white);
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 3rem;
        border: 1px solid var(--border-color);
    }

    .booking-card h3 {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: var(--text-muted);
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.9rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-family: inherit;
        font-size: 0.95rem;
        background: #fff;
        color: #333;
    }

    .w-full {
        width: 100%;
    }

    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .related-rooms-sidebar h3 {
        margin-bottom: 2rem;
    }

    .related-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .related-img {
        width: 80px;
        height: 60px;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .related-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-info h4 {
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }

    .related-info .price {
        font-size: 0.9rem;
        color: var(--primary-color);
        font-weight: 700;
    }

    @media (max-width: 992px) {
        .room-layout { grid-template-columns: 1fr; }
        .room-sidebar { order: -1; }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pricePerNight = {{ $room->price }};
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const roomsCount = document.getElementById('rooms_count');

    function updatePrice() {
        if (!checkIn.value || !checkOut.value) return;
        
        const d1 = new Date(checkIn.value);
        const d2 = new Date(checkOut.value);
        const nights = Math.max(1, Math.ceil((d2 - d1) / (1000 * 60 * 60 * 24)));
        const rooms = parseInt(roomsCount.value) || 1;
        const roomDays = rooms * nights;
        const subtotal = pricePerNight * nights * rooms;
        const discountPercent = roomDays >= 5 ? 10 : 0;
        const discountAmount = subtotal * (discountPercent / 100);
        const total = subtotal - discountAmount;

        document.getElementById('previewNights').textContent = nights;
        document.getElementById('previewRooms').textContent = rooms;
        document.getElementById('previewSubtotal').textContent = '₦' + subtotal.toLocaleString('en', {minimumFractionDigits: 2});
        document.getElementById('previewTotal').textContent = '₦' + total.toLocaleString('en', {minimumFractionDigits: 2});

        const discountRow = document.getElementById('discountRow');
        const discountHint = document.getElementById('discountHint');
        if (discountPercent > 0) {
            discountRow.style.display = 'flex';
            discountHint.style.display = 'block';
            document.getElementById('previewDiscount').textContent = '-₦' + discountAmount.toLocaleString('en', {minimumFractionDigits: 2});
        } else {
            discountRow.style.display = 'none';
            discountHint.style.display = 'none';
        }
    }

    checkIn.addEventListener('change', updatePrice);
    checkOut.addEventListener('change', updatePrice);
    roomsCount.addEventListener('change', updatePrice);
    updatePrice();
});

function swapImage(thumb, src) {
    document.getElementById('mainRoomImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}
</script>
@endsection
