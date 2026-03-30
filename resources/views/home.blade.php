@extends('layouts.app')
@section('styles')
    <style>
        .booking-widget {
            bottom: -50px;
        }
    </style>
@endsection
@section('content')

    <!-- Hero Slider Section -->
    <section class="relative min-h-screen">
        <div class="swiper hero-swiper h-screen overflow-hidden">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide hero-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                    <div class="hero-overlay"></div>
                    <div class="container relative z-10 px-4">
                        <div class="hero-content">
                            <h1 class="text-4xl md:text-6xl mb-6 text-white">Luxury Living in the <br> Heart of Paradise</h1>
                            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-2xl mx-auto">Experience world-class
                                hospitality and breathtaking views at our exclusive beach resort.</p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="#rooms" class="btn-primary">DISCOVER MORE</a>
                                <a href="{{ route('rooms.index') }}" class="btn-outline">VIEW ROOMS</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide hero-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                    <div class="hero-overlay"></div>
                    <div class="container relative z-10 px-4">
                        <div class="hero-content">
                            <h1 class="text-4xl md:text-6xl mb-6 text-white">Unforgettable <br> Experiences Await</h1>
                            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-2xl mx-auto">From sunset dinners to
                                private yacht tours, we curate every moment for perfection.</p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="{{ route('about') }}" class="btn-primary">OUR STORY</a>
                                <a href="{{ route('contact') }}" class="btn-outline">GET IN TOUCH</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide hero-slide"
                    style="background-image: url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                    <div class="hero-overlay"></div>
                    <div class="container relative z-10 px-4">
                        <div class="hero-content">
                            <h1 class="text-4xl md:text-6xl mb-6 text-white">Relax and <br> Rejuvenate</h1>
                            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-2xl mx-auto">Indulge in our world-class
                                spa and infinity pools overlooking the ocean.</p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="#facilities" class="btn-primary">SPA & WELLNESS</a>
                                <a href="{{ route('rooms.index') }}" class="btn-outline">BOOK A SUITE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Navigation -->
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
        </div>

        <!-- Booking Widget Overlay -->
        <div class="booking-widget container mx-auto px-4 z-10 w-full max-w-6xl">
            <form action="{{ route('rooms.index') }}" method="GET"
                class="booking-form bg-white shadow-2xl p-6 md:p-8 flex flex-col md:flex-row items-center md:items-end gap-6 border-b-4 border-primary rounded-lg mx-auto">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Arrival Date</label>
                    <input type="date" name="check_in"
                        class="w-full border-b border-gray-200 py-2 focus:border-primary outline-none text-gray-700 bg-transparent"
                        value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Departure
                        Date</label>
                    <input type="date" name="check_out"
                        class="w-full border-b border-gray-200 py-2 focus:border-primary outline-none text-gray-700 bg-transparent"
                        value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                </div>
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Guests</label>
                    <select name="guests"
                        class="w-full border-b border-gray-200 py-2 focus:border-primary outline-none text-gray-700 bg-transparent appearance-none">
                        <option value="1">1 Person</option>
                        <option value="2">2 Persons</option>
                        <option value="3">3 Persons</option>
                        <option value="4">4+ Persons</option>
                    </select>
                </div>
                <div class="w-full md:w-auto mt-4 md:mt-0">
                    <button type="submit"
                        class="btn-primary w-full md:w-auto px-8 py-4 font-bold tracking-widest text-sm hover:-translate-y-1 transition-transform">CHECK
                        AVAILABILITY</button>
                </div>
            </form>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section-padding">
        <div class="container about-grid">
            <div class="about-image" data-aos="fade-zoom-out">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Resort View">
            </div>
            <div class="about-content">
                <div data-aos="fade-zoom-in">
                    <span class="subtitle">Our Story</span>
                    <h2 class="section-title">The Ultimate Luxury <br> Experience</h2>
                    <p class="mb-6">Nestled between the azure waves and lush tropical gardens, Kingswood Hotel and Suites
                        offers a
                        sanctuary of peace and elegance. Our commitment to excellence ensures every guest enjoys a truly
                        memorable stay.</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <span>Exclusive private beach access</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <span>World-class spa and wellness center</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <span>Gourmet dining with panoramic views</span>
                        </li>
                    </ul>
                    <a href="{{ route('about') }}" class="btn btn-primary">Read More About Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Rooms -->
    <section class="featured-rooms section-padding bg-bg-alt">
        <div class="container text-center mb-12">
            <span class="subtitle">Accommodations</span>
            <h2 class="section-title">Our Luxurious Rooms & Suites</h2>
        </div>

        <div class="container rooms-carousel">
            @foreach ($featuredRooms as $room)
                <div class="room-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="room-img-container">
                        <img src="{{ !empty($room->images[0]) ? (str_starts_with($room->images[0], 'http') ? $room->images[0] : asset('uploads/rooms/' . $room->images[0])) : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}"
                            alt="{{ $room->name }}">
                        <div class="room-price-tag">${{ $room->price }} / Night</div>
                    </div>
                    <div class="room-content">
                        <span
                            class="text-primary uppercase text-xs font-bold tracking-widest">{{ $room->category->name }}</span>
                        <h3 class="text-2xl mt-2 mb-4"><a
                                href="{{ route('rooms.show', $room->slug) }}">{{ $room->name }}</a></h3>
                        <div class="room-meta">
                            <span><i class="far fa-user mr-2"></i> {{ $room->capacity }} Person(s)</span>
                        </div>
                        <a href="{{ route('rooms.show', $room->slug) }}"
                            class="text-black font-bold border-b-2 border-primary pb-1 hover:text-primary transition-all">Explore
                            Room</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('rooms.index') }}" class="btn btn-primary">View All Rooms</a>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="facilities section-padding">
        <div class="container text-center mb-12">
            <span class="subtitle">Exclusive Facilities</span>
            <h2 class="section-title">World Class Amenities</h2>
        </div>

        <div class="container facilities-grid">
            <div class="facility-card" data-aos="fade-up">
                <i class="fas fa-utensils"></i>
                <h3>Restaurant & Bar</h3>
                <p>Savor exquisite cuisines prepared by our world-renowned chefs.</p>
            </div>
            <div class="facility-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-spa"></i>
                <h3>Spa & Wellness</h3>
                <p>Rejuvenate your body and mind in our serene spa environment.</p>
            </div>
            <div class="facility-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-swimmer"></i>
                <h3>Infinity Pool</h3>
                <p>Take a dip in our breathtaking infinity pool overlooking the sea.</p>
            </div>
            <div class="facility-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-dumbbell"></i>
                <h3>Fitness Center</h3>
                <p>Maintain your fitness routine with our state-of-the-art gym equipment.</p>
            </div>
        </div>
    </section>


    <!-- Gallery Section -->
    <section id="gallery" class="gallery section-padding bg-bg-alt">
        <div class="container text-center mb-12">
            <span class="subtitle">Our Visual Story</span>
            <h2 class="section-title">The Kingswood Gallery</h2>

            <div class="gallery-filters mt-8 flex flex-wrap justify-center gap-4">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="rooms">Rooms</button>
                <button class="filter-btn" data-filter="dining">Dining</button>
                <button class="filter-btn" data-filter="beach">Beach</button>
                <button class="filter-btn" data-filter="lifestyle">Lifestyle</button>
            </div>
        </div>

        <div class="container gallery-grid">
            <div class="gallery-item" data-category="rooms" data-aos="zoom-in">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Luxury Suite">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Luxury Suite</span>
                </div>
            </div>
            <div class="gallery-item" data-category="beach" data-aos="zoom-in" data-aos-delay="100">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Private Beach">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Private Beach</span>
                </div>
            </div>
            <div class="gallery-item" data-category="dining" data-aos="zoom-in" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Gourmet Dining">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Gourmet Dining</span>
                </div>
            </div>
            <div class="gallery-item" data-category="lifestyle" data-aos="zoom-in" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Spa Retreat">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Spa Retreat</span>
                </div>
            </div>
            <div class="gallery-item" data-category="rooms" data-aos="zoom-in" data-aos-delay="400">
                <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Modern Interior">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Modern Interior</span>
                </div>
            </div>
            <div class="gallery-item" data-category="beach" data-aos="zoom-in" data-aos-delay="500">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Infinity Pool">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Infinity Pool</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials section-padding"
        style="background-image: url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="testimonial-overlay"></div>
        <div class="container relative z-10 text-center">
            <span class="subtitle text-primary">Guest Stories</span>
            <h2 class="section-title text-white mb-12" style="color:#fff !important;">What Our Guests Say</h2>

            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card mx-auto">
                                <i class="fas fa-quote-left quote-icon"></i>
                                <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                                <div class="testimonial-stars" style="margin-bottom: 0.5rem;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"
                                            style="color: {{ $i <= $testimonial->rating ? '#f59e0b' : '#4a5568' }}; font-size: 0.9rem;"></i>
                                    @endfor
                                </div>
                                <div class="testimonial-author">
                                    <span class="author-name">{{ $testimonial->guest_name }}</span>
                                    <span class="author-location">{{ $testimonial->guest_location ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback if no testimonials -->
                        <div class="swiper-slide">
                            <div class="testimonial-card mx-auto">
                                <i class="fas fa-quote-left quote-icon"></i>
                                <p class="testimonial-text">"An unforgettable stay. The Kingswood team made every moment
                                    special."</p>
                                <div class="testimonial-author">
                                    <span class="author-name">Happy Guest</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Testimonial Pagination -->
                <div class="swiper-pagination testimonial-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Latest Blog -->
    <section class="latest-blog section-padding bg-white">
        <div class="container text-center mb-12">
            <span class="subtitle">Latest News</span>
            <h2 class="section-title">From Our Hotel Blog</h2>
        </div>

        <div class="container blog-grid">
            @foreach ($latestPosts as $post)
                <div class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="blog-img">
                        <img src="{{ !empty($post->image) ? (str_starts_with($post->image, 'http') ? $post->image : asset('uploads/blog/' . $post->image)) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}"
                            alt="{{ $post->title }}">
                    </div>
                    <div class="blog-content">
                        <span
                            class="text-primary font-bold text-xs uppercase tracking-widest">{{ $post->created_at->format('M d, Y') }}</span>
                        <h3 class="text-xl mt-2 mb-4 leading-tight"><a href="{{ route('blog.show', $post->slug) }}"
                                class="hover:text-primary transition-all">{{ $post->title }}</a></h3>
                        <p class="text-gray-500 mb-4">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="inline-block border-b-2 border-primary font-bold text-black uppercase text-xs tracking-widest hover:text-primary transition-all">Read
                            More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter section-padding" style="background-color: var(--color-primary);">
        <div class="container flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-white">
                <h2 class="text-3xl font-serif mb-2">Subscribe To Our Newsletter</h2>
                <p class="text-white/80">Stay updated with our latest offers and luxury hotel news.</p>
            </div>
            <form class="flex w-full md:w-auto gap-2">
                <input type="email" placeholder="Your Email Address"
                    class="bg-white/10 border border-white/20 text-white placeholder-white/60 px-6 py-4 rounded focus:outline-none focus:bg-white/20 w-full md:w-[400px]">
                <button type="submit"
                    class="bg-white text-black font-bold uppercase tracking-widest px-8 py-4 rounded hover:bg-gray-100 transition-all">Subscribe</button>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Slider
            const heroSwiper = new Swiper('.hero-swiper', {
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                speed: 1000,
            });

            // Testimonial Slider
            const testimonialSwiper = new Swiper('.testimonial-swiper', {
                loop: true,
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.testimonial-pagination',
                    clickable: true,
                },
                speed: 800,
            });

            // Gallery Filtering
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update active button
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const filter = btn.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        if (filter === 'all' || item.getAttribute('data-category') ===
                            filter) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        });
    </script>
@endsection
