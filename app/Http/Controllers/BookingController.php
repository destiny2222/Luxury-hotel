<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms_count' => 'required|integer|min:1|max:10',
            'payment_method' => 'required|in:full,deposit_50,pay_at_hotel',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $roomsCount = (int) $validated['rooms_count'];

        // Check availability
        $isBooked = Booking::where('room_id', $room->id)
            ->whereNotIn('status', ['cancelled'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                      ->where('check_out', '>', $checkIn);
                });
            })->exists();

        if ($isBooked) {
            Alert::error('Error', 'Room is not available for the selected dates.');
            return back();
        }

        // Calculate discount
        $pricing = Booking::calculateDiscount($roomsCount, $nights, (float) $room->price);

        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'rooms_count' => $roomsCount,
            'nights' => $nights,
            'subtotal' => $pricing['subtotal'],
            'discount_percent' => $pricing['discount_percent'],
            'discount_amount' => $pricing['discount_amount'],
            'total_price' => $pricing['total_price'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'status' => 'pending',
            'guest_info' => [
                'name' => $validated['guest_name'],
                'email' => $validated['guest_email'],
                'phone' => $validated['guest_phone'],
            ],
        ]);

        // Handle payment flow
        if ($validated['payment_method'] === 'pay_at_hotel') {
            $booking->update(['status' => 'confirmed']);
            Alert::success('Success', 'Booking confirmed! You will pay at the hotel upon arrival.');
            return redirect()->route('booking.success', $booking->booking_reference);
        }

        // For online payments, redirect to Flutterwave payment page
        return redirect()->route('booking.payment', $booking->booking_reference);
    }

    /**
     * Show the Flutterwave payment page with inline JS checkout
     */
    public function payment($reference)
    {
        $booking = Booking::with('room')->where('booking_reference', $reference)->firstOrFail();

        // Don't allow payment if already paid
        if ($booking->payment_status === 'paid') {
            Alert::info('Info', 'This booking has already been paid for.');
            return redirect()->route('booking.success', $booking->booking_reference);
        }

        // Calculate the charge amount based on payment method
        $chargeAmount = $booking->payment_method === 'deposit_50'
            ? round($booking->total_price * 0.5, 2)
            : round($booking->total_price, 2);

        $publicKey = config('services.flutterwave.public_key');

        if (empty($publicKey)) {
            // Flutterwave not configured, fallback to pay-at-hotel
            $booking->update(['payment_method' => 'pay_at_hotel', 'status' => 'confirmed']);
            Alert::warning('Warning', 'Online payment is currently unavailable. Your booking has been confirmed for pay-at-hotel.');
            return redirect()->route('booking.success', $booking->booking_reference);
        }

        // $response = Http::withToken(config('flutterwave.secret_key'))
        //     ->post(config('flutterwave.base_url') . '/payments', [
        //         'tx_ref' => $booking->booking_reference,
        //         'amount' => $chargeAmount,
        //         'currency' => 'NGN',
        //         'redirect_url' => url('/booking/callback'),
        //         'customer' => [
        //             'email' => $booking->guest_info['email'],
        //             'name' => $booking->guest_info['name'],
        //             'phonenumber' => $booking->guest_info['phone'],
        //         ],
        //         'customizations' => [
        //             'title' => 'Sea Pearl Resort Booking',
        //             'description' => "Booking #{$booking->booking_reference}",
        //         ],
        //     ]);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     if (isset($data['data']['link'])) {
        //         return redirect($data['data']['link']);
        //     }
        // }

        // // Fallback if Flutterwave fails
        // return redirect()->route('booking.success', $booking->booking_reference)
        //     ->with('warning', 'Could not initiate online payment. Please pay at the hotel.');
            return view('bookings.payment', compact('booking', 'chargeAmount', 'publicKey'));
    }

    public function success($reference)
    {
        $booking = Booking::with('room')->where('booking_reference', $reference)->firstOrFail();
        return view('bookings.success', compact('booking'));
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::user()->id)
            ->with('room')
            ->latest()
            ->paginate(10);
        return view('bookings.history', compact('bookings'));
    }

    public function calculatePrice(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rooms_count' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);
        $nights = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));
        $pricing = Booking::calculateDiscount((int)$request->rooms_count, $nights, (float)$room->price);

        return response()->json($pricing);
    }
}
