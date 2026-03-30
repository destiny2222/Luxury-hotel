@extends('layouts.app')
@section('content')
@section('styles')
   <style>
    @media screen and (max-width: 768px) {
    .page-header h1 {
        font-size: 2.5rem;
    }
}

</style>

@endsection
<!-- Page Header -->
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Luxury Rooms & Suites</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Our Rooms</span>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section class="section-padding bg-white">
    <div class="container">
        <!-- Room Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <button class="filter-btn px-8 py-3 rounded-full border border-gray-200 font-bold uppercase tracking-widest text-xs transition-all active bg-primary text-white border-primary" data-category="all">All Rooms</button>
            @foreach($categories as $category)
                <button class="filter-btn px-8 py-3 rounded-full border border-gray-200 font-bold uppercase tracking-widest text-xs transition-all hover:bg-primary hover:text-white hover:border-primary" data-category="{{ $category->slug }}">{{ $category->name }}</button>
            @endforeach
        </div>

        <!-- Room Grid -->
        <div class="rooms-grid">
            @foreach($rooms as $room)
            <div class="room-card-v2" data-category="{{ $room->category->slug }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="room-img">
                    <img src="{{ !empty($room->images[0]) ? (str_starts_with($room->images[0], 'http') ? $room->images[0] : asset('uploads/rooms/' . $room->images[0])) : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" alt="{{ $room->name }}">
                    <div class="room-price-tag">${{ $room->price }} / Night</div>
                </div>
                <div class="room-info">
                    <span class="text-primary font-bold text-xs uppercase tracking-widest">{{ $room->category->name }}</span>
                    <h3 class="text-2xl mt-2 mb-4"><a href="{{ route('rooms.show', $room->slug) }}" class="hover:text-primary transition-all">{{ $room->name }}</a></h3>
                    <p class="text-gray-500 text-sm mb-6">{{ Str::limit(strip_tags($room->description), 80) }}</p>
                    
                    <div class="room-meta">
                        {{-- <span><i class="fas fa-expand-arrows-alt mr-2"></i> 330 SQ</span> --}}
                        <span><i class="fas fa-user-friends mr-2"></i> {{ $room->capacity }} Person(s)</span>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('rooms.show', $room->slug) }}" class="btn-primary w-full text-center py-4 text-xs font-bold tracking-widest">BOOK NOW</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $rooms->links() }}
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const roomCards = document.querySelectorAll('.room-card-v2');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.getAttribute('data-category');

                // Update active button
                filterBtns.forEach(b => {
                    b.classList.remove('bg-primary', 'text-white', 'border-primary');
                    b.classList.add('border-gray-200');
                });
                btn.classList.add('bg-primary', 'text-white', 'border-primary');
                btn.classList.remove('border-gray-200');

                // Filter cards
                roomCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                        // Re-trigger AOS if needed
                        // AOS.refresh();
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection

