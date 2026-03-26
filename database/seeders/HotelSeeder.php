<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RoomCategory;
use App\Models\Room;
use App\Models\Service;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Categories
        $cat1 = RoomCategory::create([
            'name' => 'Luxury Suite',
            'slug' => 'luxury-suite',
            'description' => 'Experience ultimate comfort in our luxury suites.',
            'image' => 'https://images.unsplash.com/photo-1591088398332-8a77d399c842?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ]);

        $cat2 = RoomCategory::create([
            'name' => 'Deluxe Room',
            'slug' => 'deluxe-room',
            'description' => 'Modern design and spacious layout for your relaxation.',
            'image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ]);

        // Sample Rooms
        Room::create([
            'room_category_id' => $cat1->id,
            'name' => 'Ocean View Suite',
            'slug' => 'ocean-view-suite',
            'description' => 'A spacious suite with a breathtaking view of the ocean.',
            'price' => 350.00,
            'amenities' => ['Wi-Fi', 'TV', 'Mini Bar', 'Air Conditioning', 'Sea View'],
            'images' => [
                'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'capacity' => 2,
            'status' => 'available'
        ]);

        Room::create([
            'room_category_id' => $cat1->id,
            'name' => 'Presidential Suite',
            'slug' => 'presidential-suite',
            'description' => 'The height of luxury, perfect for high-profile guests.',
            'price' => 750.00,
            'amenities' => ['Wi-Fi', 'TV', 'Private Pool', 'Butler Service'],
            'images' => [
                'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'capacity' => 4,
            'status' => 'available'
        ]);

        Room::create([
            'room_category_id' => $cat2->id,
            'name' => 'City Skyline Room',
            'slug' => 'city-skyline-room',
            'description' => 'Enjoy the city lights from your comfortable room.',
            'price' => 220.00,
            'amenities' => ['Wi-Fi', 'TV', 'Mini Bar'],
            'images' => [
                'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'capacity' => 2,
            'status' => 'available'
        ]);

        // Sample Services
        Service::create([
            'name' => 'Gourmet Restaurant',
            'slug' => 'gourmet-restaurant',
            'description' => 'Exquisite dining with a variety of international cuisines.',
            'icon' => 'utensils',
            'image' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ]);

        Service::create([
            'name' => 'SPA & Wellness',
            'slug' => 'spa-wellness',
            'description' => 'Relax and rejuvenate with our signature spa treatments.',
            'icon' => 'spa',
            'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ]);

        Service::create([
            'name' => 'Infinity Pool',
            'slug' => 'infinity-pool',
            'description' => 'Take a dip in our iconic infinity pool with city views.',
            'icon' => 'swimming-pool',
            'image' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ]);

        // Sample Admin User
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotel.com',
            'password' => bcrypt('password'),
        ]);

        // Sample Posts
        Post::create([
            'user_id' => $user->id,
            'title' => 'Top 5 Places to Visit Near Sea Pearl',
            'slug' => 'top-5-places-to-visit',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published'
        ]);
    }
}
