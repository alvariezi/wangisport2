<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('timeslots', 'day_of_week')) {
            Schema::table('timeslots', function (Blueprint $table) {
                // Nullable agar timeslot lama tidak rusak; jadwal baru wajib mengisi hari.
                $table->unsignedTinyInteger('day_of_week')->nullable()->after('court_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('timeslots', 'day_of_week')) {
            Schema::table('timeslots', function (Blueprint $table) {
                $table->dropColumn('day_of_week');
            });
        }
    }
};
