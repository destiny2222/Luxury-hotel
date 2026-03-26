<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingEditRequest;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['room', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('booking_reference', 'like', "%{$request->search}%")
                  ->orWhereHas('room', fn($r) => $r->where('name', 'like', "%{$request->search}%"));
            });
        }

        $bookings = $query->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['room', 'user', 'editRequests.requestedBy', 'editRequests.approvedBy']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $sensitiveFields = ['paid_amount', 'check_in', 'check_out', 'payment_status'];
        $user = auth()->user();

        $validated = $request->validate([
            'status' => 'sometimes|in:pending,confirmed,checked_in,checked_out,cancelled',
            'paid_amount' => 'sometimes|numeric|min:0',
            'check_in' => 'sometimes|date',
            'check_out' => 'sometimes|date',
            'payment_status' => 'sometimes|in:pending,partial,paid',
        ]);

        // Front desk users: sensitive field changes go through approval
        if ($user->isFrontDesk()) {
            $needsApproval = false;
            foreach ($sensitiveFields as $field) {
                if (isset($validated[$field]) && (string) $booking->$field !== (string) $validated[$field]) {
                    BookingEditRequest::create([
                        'booking_id' => $booking->id,
                        'requested_by' => $user->id,
                        'field_name' => $field,
                        'old_value' => (string) $booking->$field,
                        'new_value' => (string) $validated[$field],
                        'reason' => $request->input('reason', 'Front desk edit'),
                        'status' => 'pending',
                    ]);
                    $needsApproval = true;
                    unset($validated[$field]); // Don't apply directly
                }
            }

            // Apply only non-sensitive changes
            if (!empty($validated)) {
                // Only status changes that are not sensitive are allowed
                if (isset($validated['status'])) {
                    $booking->update(['status' => $validated['status']]);
                }
            }

            if ($needsApproval) {
                return back()->with('info', 'Sensitive changes have been submitted for supervisor approval.');
            }
        } else {
            // Supervisors and super admins can update directly
            $booking->update($validated);
        }

        return back()->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        if (!auth()->user()->canDelete()) {
            abort(403, 'You do not have permission to delete bookings.');
        }

        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
