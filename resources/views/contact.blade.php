@extends('layouts.app')
@section('styles')
   <style>
    @media screen and (max-width: 768px) {
    .page-header h1 {
        font-size: 2.5rem;
    }
}

   </style>

@endsection
@section('content')
<!-- Page Header -->
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Keep In Touch</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Contact Us</span>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="contact-grid">
            <div data-aos="fade-right">
                <span class="subtitle">Get In Touch</span>
                <h2 class="section-title text-left">We're Ready To Help You</h2>
                <p class="text-gray-500 mb-10">Have questions about our rooms, services, or want to make a special request? Our team is available 24/7 to ensure your stay is perfect.</p>
                
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4 class="text-lg font-bold">Resort Location</h4>
                            <p class="text-gray-500">123 Luxury Way, Coastal City, CA 90210</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <h4 class="text-lg font-bold">Phone Number</h4>
                            <p class="text-gray-500">+1 (123) 456-7890</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4 class="text-lg font-bold">Email Address</h4>
                            <p class="text-gray-500">stay@seapearl.com</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-card mt-12">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="name" placeholder="Full Name" class="contact-form-input" required>
                            <input type="email" name="email" placeholder="Email Address" class="contact-form-input" required>
                        </div>
                        <input type="text" name="subject" placeholder="Subject" class="contact-form-input" required>
                        <textarea name="message" rows="5" placeholder="Your Message" class="contact-form-input rounded-3xl" required></textarea>
                        <button type="submit" class="btn-primary w-full py-4 tracking-widest font-bold">SEND MESSAGE <i class="fas fa-arrow-right ml-2"></i></button>
                    </form>
                </div>
            </div>
            
            <div class="hidden lg:block h-full min-h-[600px]" data-aos="fade-left">
                <div class="h-full rounded-lg overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1544124499-58912cbddaad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=100" alt="Contact Decoration" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

