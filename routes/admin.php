<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingEditRequestController;
use App\Http\Controllers\Admin\PostController;

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Rooms
    Route::resource('rooms', RoomController::class)->except(['show']);
    Route::patch('rooms/{room}/toggle-status', [RoomController::class, 'toggleStatus'])->name('rooms.toggle-status');

    // Bookings
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show', 'edit']);

    // Posts
    Route::resource('posts', PostController::class)->except(['show']);

    // Contact messages
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Users (super_admin only)
    Route::middleware('role:super_admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    });

    // Edit requests (supervisor + super_admin)
    Route::middleware('role:super_admin,supervisor')->group(function () {
        Route::get('edit-requests', [BookingEditRequestController::class, 'index'])->name('edit-requests.index');
        Route::patch('edit-requests/{editRequest}/approve', [BookingEditRequestController::class, 'approve'])->name('edit-requests.approve');
        Route::patch('edit-requests/{editRequest}/reject', [BookingEditRequestController::class, 'reject'])->name('edit-requests.reject');
    });
});
