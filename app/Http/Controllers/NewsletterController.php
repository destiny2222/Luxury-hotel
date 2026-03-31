<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subscriber;
use RealRashid\SweetAlert\Facades\Alert;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
            'verified_at' => now(), // Auto-verify for now, or send verification email
        ]);

        Alert::success('Subscribed!', 'You have successfully subscribed to our newsletter.');

        return back();
    }

    public function unsubscribe($token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();
        $subscriber->delete();

        Alert::success('Unsubscribed', 'You have been successfully removed from our mailing list.');

        return redirect()->route('home');
    }
}
