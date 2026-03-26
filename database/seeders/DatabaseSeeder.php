<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\RoomCategory;
use App\Models\Room;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- ADMIN USERS ---
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@seapearl.com',
            'password' => 'password',
            'role' => 'super_admin',
            'phone' => '+234 800 000 0001',
        ]);

        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@seapearl.com',
            'password' => 'password',
            'role' => 'supervisor',
            'phone' => '+234 800 000 0002',
        ]);

        User::create([
            'name' => 'Front Desk',
            'email' => 'frontdesk@seapearl.com',
            'password' => 'password',
            'role' => 'front_desk',
            'phone' => '+234 800 000 0003',
        ]);

        User::create([
            'name' => 'John Guest',
            'email' => 'guest@example.com',
            'password' => 'password',
            'role' => 'user',
            'phone' => '+234 800 000 0004',
        ]);

        // --- ROOM CATEGORIES ---
        $standard = RoomCategory::create(['name' => 'Standard', 'slug' => 'standard', 'description' => 'Comfortable rooms with essential amenities.']);
        $deluxe = RoomCategory::create(['name' => 'Deluxe', 'slug' => 'deluxe', 'description' => 'Spacious rooms with premium furnishings.']);
        $suite = RoomCategory::create(['name' => 'Suite', 'slug' => 'suite', 'description' => 'Luxury suites with separate living areas.']);
        $presidential = RoomCategory::create(['name' => 'Presidential', 'slug' => 'presidential', 'description' => 'The finest accommodation with exclusive privileges.']);

        // --- ROOMS ---
        $rooms = [
            ['category' => $standard, 'name' => 'Ocean View Standard', 'price' => 35000, 'capacity' => 2,
             'description' => 'A serene room featuring comfortable bedding, a work desk, and a stunning view of the ocean. Perfect for solo travelers or couples seeking a relaxing getaway.',
             'amenities' => ['WiFi', 'Air Conditioning', 'TV', 'Room Service', 'Safe'],
             'images' => [
                 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
            ['category' => $standard, 'name' => 'Garden View Standard', 'price' => 30000, 'capacity' => 2,
             'description' => 'Overlooking our tropical gardens, this room offers a tranquil escape with all essential amenities.',
             'amenities' => ['WiFi', 'Air Conditioning', 'TV', 'Mini Bar'],
             'images' => [
                 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
            ['category' => $deluxe, 'name' => 'Deluxe King Room', 'price' => 55000, 'capacity' => 2,
             'description' => 'An elegantly appointed room featuring a king-size bed, marble bathroom, and a private balcony overlooking the resort.',
             'amenities' => ['WiFi', 'Air Conditioning', 'TV', 'Mini Bar', 'Balcony', 'Bathtub', 'Room Service', 'Safe'],
             'images' => [
                 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
            ['category' => $deluxe, 'name' => 'Deluxe Twin Room', 'price' => 50000, 'capacity' => 3,
             'description' => 'Featuring two comfortable twin beds, this room is ideal for friends or small families looking for a premium experience.',
             'amenities' => ['WiFi', 'Air Conditioning', 'TV', 'Mini Bar', 'Balcony', 'Room Service'],
             'images' => [
                 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
            ['category' => $suite, 'name' => 'Executive Suite', 'price' => 95000, 'capacity' => 4,
             'description' => 'A spacious suite with a separate living room, dining area, and panoramic ocean views. Ideal for business travelers or those seeking extra luxury.',
             'amenities' => ['WiFi', 'Air Conditioning', 'TV', 'Mini Bar', 'Balcony', 'Bathtub', 'Living Room', 'Dining Area', 'Room Service', 'Safe', 'Workspace'],
             'images' => [
                 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
            ['category' => $presidential, 'name' => 'Presidential Suite', 'price' => 200000, 'capacity' => 6,
             'description' => 'Our most prestigious accommodation featuring a private terrace with jacuzzi, butler service, and unparalleled luxury that defines the Sea Pearl experience.',
             'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Full Bar', 'Private Terrace', 'Jacuzzi', 'Butler Service', 'Living Room', 'Dining Room', 'Study', 'Walk-in Closet', 'Premium Toiletries'],
             'images' => [
                 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
             ]],
        ];

        foreach ($rooms as $roomData) {
            Room::create([
                'room_category_id' => $roomData['category']->id,
                'name' => $roomData['name'],
                'slug' => Str::slug($roomData['name']),
                'description' => $roomData['description'],
                'price' => $roomData['price'],
                'capacity' => $roomData['capacity'],
                'amenities' => $roomData['amenities'],
                'images' => $roomData['images'],
                'status' => 'available',
            ]);
        }

        // --- TESTIMONIALS ---
        $testimonials = [
            ['guest_name' => 'Sarah & James Johnson', 'guest_location' => 'California, USA', 'rating' => 5, 'content' => 'Our stay at Sea Pearl was nothing short of perfection. The staff\'s attention to detail and the breathtaking views made it a truly magical experience. We can\'t wait to return!'],
            ['guest_name' => 'Michael Chen', 'guest_location' => 'Singapore', 'rating' => 5, 'content' => 'The amenities here are unparalleled. From the infinity pool to the gourmet dining, every aspect of our vacation was elevated by the Sea Pearl team. Highly recommended!'],
            ['guest_name' => 'Emma Thompson', 'guest_location' => 'London, UK', 'rating' => 5, 'content' => 'A true sanctuary of peace. The spa treatments were world-class, and the beach access feels incredibly private. The best luxury retreat we\'ve experienced in years.'],
            ['guest_name' => 'Adebayo Ogunlesi', 'guest_location' => 'Lagos, Nigeria', 'rating' => 4, 'content' => 'Outstanding service and beautiful rooms. The Presidential Suite exceeded all expectations. A brilliant gem on the coast.'],
            ['guest_name' => 'Marie Dubois', 'guest_location' => 'Paris, France', 'rating' => 5, 'content' => 'C\'est magnifique! The food, the ambiance, the sunset views—everything was curated to perfection. Sea Pearl is now our favourite retreat.'],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create(array_merge($t, [
                'status' => 'approved',
                'is_featured' => true,
            ]));
        }

        // --- SERVICES ---
        $services = [
            ['name' => 'Restaurant & Bar', 'slug' => 'restaurant-bar', 'description' => 'Savor exquisite cuisines prepared by our world-renowned chefs.', 'icon' => 'fas fa-utensils'],
            ['name' => 'Spa & Wellness', 'slug' => 'spa-wellness', 'description' => 'Rejuvenate your body and mind in our serene spa environment.', 'icon' => 'fas fa-spa'],
            ['name' => 'Infinity Pool', 'slug' => 'infinity-pool', 'description' => 'Take a dip in our breathtaking infinity pool overlooking the sea.', 'icon' => 'fas fa-swimmer'],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }

        // --- BLOG POSTS ---
        Post::create([
            'user_id' => 1,
            'title' => 'Top 10 Beach Activities at Sea Pearl',
            'slug' => 'top-10-beach-activities',
            'content' => 'Discover the most exciting activities you can enjoy at our private beach, from kayaking to sunset yoga sessions.',
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published',
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'A Guide to Our World-Class Spa',
            'slug' => 'world-class-spa-guide',
            'content' => 'From aromatherapy to deep tissue massage, explore the healing treatments available at our award-winning spa.',
            'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published',
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Culinary Delights: Meet Our Chef',
            'slug' => 'culinary-delights-meet-our-chef',
            'content' => 'Get an insider look at the creative mind behind Sea Pearl\'s gourmet dining experience.',
            'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published',
        ]);

        // --- SETTINGS ---
        Setting::create(['key' => 'hotel_name', 'value' => 'Sea Pearl Resort & Spa']);
        Setting::create(['key' => 'hotel_email', 'value' => 'stay@seapearlresort.com']);
        Setting::create(['key' => 'hotel_phone', 'value' => '+1 (305) 555-0123']);
    }
}
