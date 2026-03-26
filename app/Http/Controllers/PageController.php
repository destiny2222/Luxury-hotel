<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Service;
use App\Models\Post;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function home()
    {
        $featuredRooms = Room::with('category')->where('status', 'available')->take(3)->get();
        $services = Service::take(3)->get();
        $latestPosts = Post::where('status', 'published')->latest()->take(3)->get();
        $testimonials = Testimonial::approved()->latest()->take(5)->get();
        return view('home', compact('featuredRooms', 'services', 'latestPosts', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
