<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->uuid('public_id');
            $table->string('order_number', 30);
            $table->foreignId('venue_id')->constrained()->restrictOnDelete();
            $table->string('checkout_key', 100);
            $table->binary('tracking_token_hash', 32);
            $table->string('status', 30)->default('pending');
            $table->unsignedBigInteger('subtotal_amount')->default(0);
            $table->unsignedBigInteger('tax_amount')->default(0);
            $table->unsignedBigInteger('service_fee_amount')->default(0);
            $table->unsignedBigInteger('grand_total_amount')->default(0);
            $table->json('customer_snapshot')->nullable();
            $table->timestampTz('placed_at', 6)->nullable();
            $table->timestamps(6);
            $table->unique('public_id');
            $table->unique('order_number');
            $table->unique('checkout_key');
            $table->unique('tracking_token_hash');
            $table->index(['venue_id', 'status']);
        });
        Schema::create('court_bookings', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('commission_id');
            $table->string('status', 30)->default('pending');
            $table->date('booking_date');
            $table->decimal('commission_rate_snapshot', 6, 4);
            $table->unsignedBigInteger('subtotal_amount');
            $table->unsignedBigInteger('commission_amount');
            $table->unsignedBigInteger('net_amount');
            $table->timestamps(6);
            $table->unique(['order_id', 'tenant_id']);
            $table->unique(['tenant_id', 'id']);
            $table->index(['tenant_id', 'status', 'booking_date']);
            $table->foreign(['tenant_id', 'commission_id'])->references(['tenant_id', 'id'])->on('commission_schemes')->restrictOnDelete();
        });
        Schema::create('booking_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('court_booking_id');
            $table->unsignedBigInteger('court_id');
            $table->unsignedBigInteger('timeslot_id');
            $table->string('court_name_snapshot', 120);
            $table->time('start_time_snapshot');
            $table->time('end_time_snapshot');
            $table->unsignedBigInteger('price_snapshot');
            $table->timestamps(6);
            $table->unique(['tenant_id', 'id']);
            $table->foreign(['tenant_id', 'court_booking_id'])->references(['tenant_id', 'id'])->on('court_bookings')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_items');
        Schema::dropIfExists('court_bookings');
        Schema::dropIfExists('orders');
    }
};
