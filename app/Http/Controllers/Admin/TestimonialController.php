<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_location' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'sometimes|boolean',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'is_featured' => 'sometimes|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $testimonial->update($validated);

        return back()->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if (!auth()->user()->canDelete()) {
            abort(403);
        }
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }
}
