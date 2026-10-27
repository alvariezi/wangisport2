<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commission_schemes', function (Blueprint $table): void {
            $table->unsignedBigInteger('active_lock')
                ->virtualAs('case when `valid_to` is null then `tenant_id` else null end')
                ->nullable();

            $table->unique('active_lock', 'uq_commission_active_per_tenant');
        });

        Schema::table('tenant_bank_accounts', function (Blueprint $table): void {
            $table->unsignedBigInteger('primary_lock')
                ->virtualAs('case when `is_primary` = 1 then `tenant_id` else null end')
                ->nullable();

            $table->unique('primary_lock', 'uq_bank_primary_per_tenant');
        });
    }

    public function down(): void
    {
        Schema::table('tenant_bank_accounts', function (Blueprint $table): void {
            $table->dropUnique('uq_bank_primary_per_tenant');
            $table->dropColumn('primary_lock');
        });

        Schema::table('commission_schemes', function (Blueprint $table): void {
            $table->dropUnique('uq_commission_active_per_tenant');
            $table->dropColumn('active_lock');
        });
    }
};
