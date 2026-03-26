<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingEditRequest;

class BookingEditRequestController extends Controller
{
    public function index()
    {
        $editRequests = BookingEditRequest::with(['booking.room', 'requestedBy', 'approvedBy'])
            ->latest()
            ->paginate(15);
        return view('admin.edit-requests.index', compact('editRequests'));
    }

    public function approve(BookingEditRequest $editRequest)
    {
        if (!auth()->user()->canApproveEdits()) {
            abort(403, 'You do not have permission to approve edit requests.');
        }

        $booking = $editRequest->booking;
        $field = $editRequest->field_name;
        $newValue = $editRequest->new_value;

        // Apply the change
        $booking->update([$field => $newValue]);

        $editRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', "Edit request approved. {$field} updated.");
    }

    public function reject(BookingEditRequest $editRequest)
    {
        if (!auth()->user()->canApproveEdits()) {
            abort(403);
        }

        $editRequest->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Edit request rejected.');
    }
}
