<?php

use App\Http\Controllers\Tenant\TenantDashboardController;
use Illuminate\Support\Facades\Route;

// Portal alternatif /tenant/{tenant}/dashboard: perlu validasi keanggotaan.
// Nama route berbeda agar tidak menimpa tenant.dashboard di routes/web.php.
Route::get('/dashboard', [TenantDashboardController::class, 'index'])
    ->middleware('tenant')
    ->name('portal.dashboard');
