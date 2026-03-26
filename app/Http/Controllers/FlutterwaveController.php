<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;
use RealRashid\SweetAlert\Facades\Alert;

class FlutterwaveController extends Controller
{
    public function callback(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        $txRef = $request->query('tx_ref');

        if (!$transactionId || !$txRef) {
            Alert::error('Error', 'Invalid payment response.');
            return redirect()->route('home');
        }

        // Verify transaction with Flutterwave
        $response = Http::withToken(config('flutterwave.secret_key'))
            ->get(config('flutterwave.base_url') . "/transactions/{$transactionId}/verify");

        if ($response->successful()) {
            $data = $response->json();
            
            if ($data['status'] === 'success' && $data['data']['status'] === 'successful') {
                $booking = Booking::where('booking_reference', $txRef)->first();

                if ($booking) {
                    $paidAmount = $data['data']['amount'];
                    
                    $booking->update([
                        'transaction_id' => $transactionId,
                        'paid_amount' => $paidAmount,
                        'payment_status' => $paidAmount >= $booking->total_price ? 'paid' : 'partial',
                        'status' => 'confirmed',
                    ]);

                    Alert::success('Success', 'Payment successful! Your booking is confirmed.');
                    return redirect()->route('booking.success', $booking->booking_reference);
                }
            }
        }

        Alert::error('Error', 'Payment verification failed. Please contact support.');
        return redirect()->route('home');
    }

    public function webhook(Request $request)
    {
        // Verify webhook signature
        $secretHash = config('flutterwave.encryption_key');
        $signature = $request->header('verif-hash');

        if (!$signature || $signature !== $secretHash) {
            abort(401);
        }

        $payload = $request->all();
        
        if ($payload['event'] === 'charge.completed' && $payload['data']['status'] === 'successful') {
            $txRef = $payload['data']['tx_ref'];
            $booking = Booking::where('booking_reference', $txRef)->first();

            if ($booking) {
                $booking->update([
                    'transaction_id' => $payload['data']['id'],
                    'paid_amount' => $payload['data']['amount'],
                    'payment_status' => $payload['data']['amount'] >= $booking->total_price ? 'paid' : 'partial',
                    'status' => 'confirmed',
                ]);
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}
