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
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>About Our Hotel</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">About Us</span>
        </div>
    </div>
</section>

<!-- Who We Are -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2" data-aos="fade-right">
                <span class="subtitle">A New Vision of Luxury</span>
                <h2 class="section-title text-left">The Ultimate Escape For <br> Luxury Seekers</h2>
                <p class="text-gray-500 mb-6 leading-relaxed">Experience a world-class stay where luxury meets tranquility. Our resort is meticulously designed to provide an unparalleled experience for those seeking a peaceful escape from the everyday hustle.</p>
                <p class="text-gray-500 mb-8 leading-relaxed">Founded in 2010, Sea Pearl has grown into a premier destination for travelers worldwide. Our commitment to excellence is reflected in every architectural detail, our curated amenities, and our dedicated team's exceptional service.</p>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Years of Service</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">120</span>
                        <span class="stat-label">Luxury Rooms</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">05</span>
                        <span class="stat-label">Awards Won</span>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 relative" data-aos="fade-down">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=100" alt="Resort View" class="rounded-lg shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-primary text-white p-8 rounded-lg shadow-xl hidden md:block">
                    <span class="text-4xl font-bold block">100%</span>
                    <span class="text-sm uppercase tracking-widest font-bold">Safe & Secure</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features / Why Choose Us -->
<section class="section-padding bg-alt">
    <div class="container text-center mb-16">
        <span class="subtitle">Why Choose Us</span>
        <h2 class="section-title">The Best Luxury Experience</h2>
    </div>
    <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-10 text-center shadow-sm hover:shadow-xl transition-all" data-aos="fade-up">
            <div class="text-primary text-5xl mb-6"><i class="fas fa-concierge-bell"></i></div>
            <h3 class="text-xl font-bold mb-4">24/7 Service</h3>
            <p class="text-gray-500">Our dedicated concierge team is always ready to assist you with any request.</p>
        </div>
        <div class="bg-white p-10 text-center shadow-sm hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="100">
            <div class="text-primary text-5xl mb-6"><i class="fas fa-shield-alt"></i></div>
            <h3 class="text-xl font-bold mb-4">High Security</h3>
            <p class="text-gray-500">Your safety is our priority with 24/7 security and advanced monitoring.</p>
        </div>
        <div class="bg-white p-10 text-center shadow-sm hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
            <div class="text-primary text-5xl mb-6"><i class="fas fa-star"></i></div>
            <h3 class="text-xl font-bold mb-4">5 Star Rating</h3>
            <p class="text-gray-500">Consistently rated 5 stars for our exceptional quality and guest satisfaction.</p>
        </div>
    </div>
</section>
@endsection

