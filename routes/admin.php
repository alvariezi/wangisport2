<?php

use App\Http\Controllers\Admin\AdminCommissionController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminVenueController;
use App\Models\CommissionScheme;
use App\Models\Tenant;
use App\Models\Venue;
use Illuminate\Support\Facades\Route;

// 1. Dashboard Admin
Route::get('/dashboard', function () {
    $totalVenues = Venue::query()->count();
    $totalTenants = Tenant::query()->count();
    $activeTenants = Tenant::query()->where('status', 'active')->count();

    $latestCommission = CommissionScheme::query()
        ->whereNull('valid_to')
        ->latest('valid_from')
        ->value('commission_rate') ?? 15.00;

    $venues = Venue::with(['tenants' => function ($q) {
        $q->with('activeCommissionScheme');
    }])->get();

    return view('admin.dashboard', compact(
        'totalVenues',
        'totalTenants',
        'activeTenants',
        'latestCommission',
        'venues'
    ));
})->name('dashboard');

// 2. Rute CRUD Tenant Mitra
Route::get('/tenants', [AdminTenantController::class, 'index'])->name('tenants.index');
Route::get('/tenants/create', [AdminTenantController::class, 'create'])->name('tenants.create');
Route::post('/tenants', [AdminTenantController::class, 'store'])->name('tenants.store');
Route::get('/tenants/{tenant}/edit', [AdminTenantController::class, 'edit'])->name('tenants.edit');
Route::put('/tenants/{tenant}', [AdminTenantController::class, 'update'])->name('tenants.update');
Route::delete('/tenants/{tenant}', [AdminTenantController::class, 'destroy'])->name('tenants.destroy');

// 3. Rute CRUD Venue Arena
Route::get('/venues', [AdminVenueController::class, 'index'])->name('venues.index');
Route::get('/venues/create', [AdminVenueController::class, 'create'])->name('venues.create');
Route::post('/venues', [AdminVenueController::class, 'store'])->name('venues.store');
Route::get('/venues/{venue}/edit', [AdminVenueController::class, 'edit'])->name('venues.edit');
Route::put('/venues/{venue}', [AdminVenueController::class, 'update'])->name('venues.update');
Route::delete('/venues/{venue}', [AdminVenueController::class, 'destroy'])->name('venues.destroy');

// Rute Skema Komisi
Route::get('/commissions', [AdminCommissionController::class, 'index'])->name('commissions.index');
Route::get('/commissions/create', [AdminCommissionController::class, 'create'])->name('commissions.create');
Route::post('/commissions', [AdminCommissionController::class, 'store'])->name('commissions.store');
Route::get('/commissions/{commission}/edit', [AdminCommissionController::class, 'edit'])->name('commissions.edit');
Route::put('/commissions/{commission}', [AdminCommissionController::class, 'update'])->name('commissions.update');