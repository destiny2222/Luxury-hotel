<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->latest()->paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $categories = RoomCategory::all();
        return view('admin.rooms.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_category_id' => 'required|exists:room_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'amenities' => 'nullable|string',
            'status' => 'required|in:available,maintenance,cleaning',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,avif'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['amenities'] = $validated['amenities']
            ? array_map('trim', explode(',', $validated['amenities']))
            : [];
        $validated['images'] = [];

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/uploads/rooms'), $imageName);
                $images[] = $imageName;
            }
            $validated['images'] = $images;
        }

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $categories = RoomCategory::all();
        return view('admin.rooms.edit', compact('room', 'categories'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_category_id' => 'required|exists:room_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'amenities' => 'nullable|string',
            'status' => 'required|in:available,maintenance,cleaning',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,avif'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['amenities'] = $validated['amenities']
            ? array_map('trim', explode(',', $validated['amenities']))
            : [];

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/uploads/rooms'), $imageName);
                $images[] = $imageName;
            }
            $validated['images'] = $images;
        }

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        if (!auth()->user()->canDelete()) {
            abort(403, 'You do not have permission to delete rooms.');
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function toggleStatus(Room $room)
    {
        $newStatus = $room->status === 'available' ? 'maintenance' : 'available';
        $room->update(['status' => $newStatus]);
        return back()->with('success', "Room status changed to {$newStatus}.");
    }
}
