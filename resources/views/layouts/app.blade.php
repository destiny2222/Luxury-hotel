<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kings woods Hotel and Suites</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    @yield('styles')

    <style>
        .mobile-only{
            display: none;
        }

        .login-btn{
            color: #fff ; 
            font-weight: 500; 
            margin-right: 1rem;
        }

        @media screen and (max-width:768px) {
            .mobile-only{
                display: block;
            }
            .login-btn{
                display: none;
            }
        }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false }">
    <header class="main-header">
        <nav class="container">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <span class="logo-text">KINGSWOOD HOTEL</span>
                </a>
            </div>
            
            <ul class="nav-links" :class="{ 'active': mobileMenuOpen }">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('rooms.index') }}" class="{{ request()->routeIs('rooms.*') ? 'active' : '' }}">Rooms</a></li>
                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                @auth
                    <li><a href="{{ route('bookings.history') }}" class="{{ request()->routeIs('bookings.history') ? 'active' : '' }}">My Bookings</a></li>
                    
                    <!-- Mobile only auth links -->
                    <li class="mobile-only">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" style="color: var(--color-primary);">Dashboard</a>
                        @endif
                    </li>
                    <li class="mobile-only">
                        <form method="POST" action="{{ route('logout') }}" style="display:inline; width:100%;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:#fff; font-size:1.2rem; cursor:pointer; font-family:var(--font-body); text-transform:uppercase; letter-spacing:1px; padding:0;">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- Mobile only auth links -->
                    <li class="mobile-only"><a  href="{{ route('login') }}">Login</a></li>
                    <li class="mobile-only"><a href="{{ route('rooms.index') }}" style="color: var(--color-primary);">Book Now</a></li>
                @endauth
            </ul>
            
            <div class="header-actions">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('rooms.index') }}" class="btn btn-primary">Book Now</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: 1px solid rgba(255,255,255,0.3); color: #fff; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; font-family: inherit; font-size: 0.85rem; margin-left: 0.5rem;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="login-btn">Login</a>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Book Now</a>
                @endauth
                <button class="mobile-menu-btn" @click="mobileMenuOpen = !mobileMenuOpen">
                    <span x-show="!mobileMenuOpen">☰</span>
                    <span x-show="mobileMenuOpen">✕</span>
                </button>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="footer-top">
            <div class="container footer-grid">
                <div class="footer-info">
                    <span class="footer-logo">KINGSWOOD HOTEL AND SUITES</span>
                    <p>Experience the epitome of luxury and comfort at Kingswood Hotel and Suites. Your sanctuary of relaxation where the horizon meets the sea.</p>
                    <div class="flex gap-4 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-primary hover:border-primary transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-primary hover:border-primary transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-primary hover:border-primary transition-all"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('rooms.index') }}">Our Rooms</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4 class="footer-title">Resources</h4>
                    <ul>
                        <li><a href="{{ route('blog.index') }}">Latest News</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4 class="footer-title">Contact Info</h4>
                    <p class="mb-4"><i class="fas fa-map-marker-alt text-primary mr-3"></i> 4 Omorogbe Street, off Princess Ukponmwan Ezomo Street, off Airport Road, Oko, Benin City 300102, Edo</p>
                    <p class="mb-4"><i class="fas fa-phone-alt text-primary mr-3"></i> 08081652353</p>
                    <p class="mb-4"><i class="fab fa-whatsapp text-primary mr-3"></i> 08072638793</p>
                    <p class="mb-4"><i class="fas fa-envelope text-primary mr-3"></i> Kingswoodshotelandsuites@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} Kingswood Hotel and Suites. Crafted with Dexnovate.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        window.addEventListener('scroll', function() {
            const header = document.querySelector('.main-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
@include('sweetalert::alert')
</html>
