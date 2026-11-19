
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminVenueController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminCommissionController;

/*
|--------------------------------------------------------------------------
| DASHBOARD SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [AdminDashboardController::class, 'index']
)->name('dashboard');

/*
|--------------------------------------------------------------------------
| MANAJEMEN VENUE
|--------------------------------------------------------------------------
*/

Route::get(
    '/venues',
    [AdminVenueController::class, 'index']
)->name('venues.index');

Route::get(
    '/venues/create',
    [AdminVenueController::class, 'create']
)->name('venues.create');

Route::post(
    '/venues',
    [AdminVenueController::class, 'store']
)->name('venues.store');

Route::get(
    '/venues/{venue}/edit',
    [AdminVenueController::class, 'edit']
)->name('venues.edit');

Route::put(
    '/venues/{venue}',
    [AdminVenueController::class, 'update']
)->name('venues.update');

Route::delete(
    '/venues/{venue}',
    [AdminVenueController::class, 'destroy']
)->name('venues.destroy');

/*
|--------------------------------------------------------------------------
| MANAJEMEN TENANT
|--------------------------------------------------------------------------
*/

Route::get(
    '/tenants',
    [AdminTenantController::class, 'index']
)->name('tenants.index');

Route::get(
    '/tenants/create',
    [AdminTenantController::class, 'create']
)->name('tenants.create');

Route::post(
    '/tenants',
    [AdminTenantController::class, 'store']
)->name('tenants.store');

Route::get(
    '/tenants/{tenant}/edit',
    [AdminTenantController::class, 'edit']
)->name('tenants.edit');

Route::put(
    '/tenants/{tenant}',
    [AdminTenantController::class, 'update']
)->name('tenants.update');

Route::delete(
    '/tenants/{tenant}',
    [AdminTenantController::class, 'destroy']
)->name('tenants.destroy');

/*
|--------------------------------------------------------------------------
| ROUTE KOMPATIBILITAS SKEMA KOMISI
| Menu tidak ditampilkan di sidebar
|--------------------------------------------------------------------------
*/

Route::get(
    '/commissions',
    [AdminCommissionController::class, 'index']
)->name('commissions.index');

Route::get(
    '/commissions/create',
    [AdminCommissionController::class, 'create']
)->name('commissions.create');

Route::post(
    '/commissions',
    [AdminCommissionController::class, 'store']
)->name('commissions.store');

Route::get(
    '/commissions/{commission}/edit',
    [AdminCommissionController::class, 'edit']
)->name('commissions.edit');

Route::put(
    '/commissions/{commission}',
    [AdminCommissionController::class, 'update']
)->name('commissions.update');
