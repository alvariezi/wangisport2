<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_operating_hours', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('day_of_week');
            $table->time('opens_at');
            $table->time('closes_at');
            $table->timestamps(6);
            $table->unique(['tenant_id', 'day_of_week']);
        });
        Schema::create('commission_schemes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->decimal('commission_rate', 6, 4);
            $table->timestampTz('valid_from', 6);
            $table->timestampTz('valid_to', 6)->nullable();
            $table->timestamps(6);
            $table->unique(['tenant_id', 'id']);
            $table->index(['tenant_id', 'valid_from']);
        });
        Schema::create('courts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120);
            $table->string('type', 40); // futsal, badminton, basket, padel
            $table->string('surface_type', 60)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps(6);
            $table->unique(['tenant_id', 'name']);
            $table->unique(['tenant_id', 'id']);
        });
        Schema::create('timeslots', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('court_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('base_price');
            $table->boolean('is_peak_rate')->default(false);
            $table->boolean('is_available')->default(true);
            $table->timestamps(6);
            $table->unique(['tenant_id', 'id']);
            $table->index(['tenant_id', 'court_id', 'is_available']);
            $table->foreign(['tenant_id', 'court_id'])->references(['tenant_id', 'id'])->on('courts')->restrictOnDelete();
        });
        Schema::create('add_ons', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120);
            $table->unsignedBigInteger('price');
            $table->integer('stock_qty')->default(0);
            $table->boolean('is_available')->default(true);
            $table->timestamps(6);
            $table->unique(['tenant_id', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('add_ons');
        Schema::dropIfExists('timeslots');
        Schema::dropIfExists('courts');
        Schema::dropIfExists('commission_schemes');
        Schema::dropIfExists('tenant_operating_hours');
    }
};
