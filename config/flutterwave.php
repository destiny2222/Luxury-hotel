<?php

return [
    'public_key' => env('FLUTTERWAVE_PUBLIC_KEY', ''),
    'secret_key' => env('FLUTTERWAVE_SECRET_KEY', ''),
    'encryption_key' => env('FLUTTERWAVE_ENCRYPTION_KEY', ''),
    'base_url' => 'https://api.flutterwave.com/v3',
    'redirect_url' => env('FLUTTERWAVE_REDIRECT_URL', '/booking/callback'),
];
