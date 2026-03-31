<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlutterwaveController;
use App\Http\Controllers\NewsletterController;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{slug}', [RoomController::class, 'show'])->name('rooms.show');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/bookings/calculate-price', [BookingController::class, 'calculatePrice'])->name('bookings.calculate');
Route::get('/booking/payment/{reference}', [BookingController::class, 'payment'])->name('booking.payment');
Route::get('/booking/success/{reference}', [BookingController::class, 'success'])->name('booking.success');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Payment callbacks
Route::get('/booking/callback', [FlutterwaveController::class, 'callback'])->name('booking.callback');
Route::post('/booking/webhook', [FlutterwaveController::class, 'webhook'])->name('booking.webhook');

// Auth routes
Route::middleware('guest')->group(function () {
    // User Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Admin Auth
    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'history'])->name('bookings.history');
});
