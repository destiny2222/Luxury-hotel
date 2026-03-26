<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('booking_reference')->unique();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('rooms_count')->default(1);
            $table->integer('nights')->default(1);
            $table->decimal('subtotal', 10, 2); // price before discount
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('payment_method', ['full', 'deposit_50', 'pay_at_hotel'])->default('pay_at_hotel');
            $table->enum('payment_status', ['pending', 'partial', 'paid'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->json('guest_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
