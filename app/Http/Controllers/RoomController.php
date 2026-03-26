<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\RoomCategory;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters from the booking widget
        $check_in = $request->input('check_in', date('Y-m-d'));
        $check_out = $request->input('check_out', date('Y-m-d', strtotime('+1 day')));
        $guests = $request->input('guests', 1);

        $rooms = Room::with('category')->where('status', 'available')->paginate(10)->withQueryString();
        $categories = RoomCategory::all();
        
        return view('rooms.index', compact('rooms', 'categories', 'check_in', 'check_out', 'guests'));
    }

    public function show($slug)
    {
        $room = Room::with('category')->where('slug', $slug)->firstOrFail();
        $relatedRooms = Room::where('room_category_id', $room->room_category_id)
            ->where('id', '!=', $room->id)
            ->take(3)
            ->get();
        return view('rooms.show', compact('room', 'relatedRooms'));
    }
}
