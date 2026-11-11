<?php

use App\Http\Controllers\Admin\AdminCommissionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminVenueController;

use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\CustomerHomeController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\VenueCatalogController;

use App\Http\Controllers\Tenant\TenantDashboardController;
use App\Http\Controllers\Tenant\TenantCourtController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/dashboard', [CustomerHomeController::class, 'index'])
    ->name('customer.dashboard');

// Katalog venue
Route::get('/venues', [VenueCatalogController::class, 'index'])
    ->name('venues.index');

// Detail venue
Route::get('/venues/{venue:slug}', [VenueCatalogController::class, 'showVenue'])
    ->name('venues.show');

// Detail tenant
Route::get('/venues/{venue:slug}/tenants/{tenant:slug}', [VenueCatalogController::class, 'showTenant'])
    ->name('tenants.show');

// Cek ketersediaan jadwal
Route::get('/availability', [VenueCatalogController::class, 'checkAvailability'])
    ->name('availability.check');


/*
|--------------------------------------------------------------------------
| 2. RUTE PENGGUNA TERAUTENTIKASI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Redirect Dashboard Berdasarkan Role
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $user = Auth::user();

        if ($user?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user?->role === 'tenant') {
            return redirect()->route('tenant.dashboard');
        }

        return redirect()->route('customer.dashboard');

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | 3. PORTAL CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::prefix('customer')
        ->name('customer.')
        ->group(function () {

            // Home Customer
            Route::get('/dashboard', [CustomerHomeController::class, 'index'])
                ->name('dashboard');

            Route::get('/booking/checkout', [BookingController::class, 'checkout'])
                ->name('booking.checkout');

            Route::post('/booking/process', [BookingController::class, 'process'])
                ->name('booking.process');

            Route::get('/orders', [BookingController::class, 'index'])
                ->name('orders.index');

            Route::get('/orders/{orderNumber}', [BookingController::class, 'show'])
                ->name('orders.show');
        });


    /*
    |--------------------------------------------------------------------------
    | 4. PORTAL SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [AdminDashboardController::class, 'index'])
                ->name('dashboard');

            // Manajemen Venue
            Route::resource('venues', AdminVenueController::class);

            // Manajemen Tenant
            Route::resource('tenants', AdminTenantController::class);

            // Manajemen Komisi
            Route::get('/commissions', [AdminCommissionController::class, 'index'])
                ->name('commissions.index');

            Route::get('/commissions/create', [AdminCommissionController::class, 'create'])
                ->name('commissions.create');

            Route::post('/commissions', [AdminCommissionController::class, 'store'])
                ->name('commissions.store');

            Route::get('/commissions/{commission}/edit', [AdminCommissionController::class, 'edit'])
                ->name('commissions.edit');

            Route::put('/commissions/{commission}', [AdminCommissionController::class, 'update'])
                ->name('commissions.update');
        });


    

/*
|--------------------------------------------------------------------------
| PORTAL TENANT MITRA (RUTE KHUSUS BEBAS BENTROK)
|--------------------------------------------------------------------------
*/

Route::prefix('tenant')
    ->name('tenant.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard Tenant
        Route::get('/dashboard', [TenantDashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | CRUD KELOLA LAPANGAN
        |--------------------------------------------------------------------------
        | Menggunakan nama courts.manage.* agar tidak bentrok
        | dengan modul Catalog.
        */

        // Menampilkan Daftar Lapangan
        Route::get('/manage-courts', [TenantCourtController::class, 'index'])
            ->name('courts.manage');

        // Form Tambah Lapangan
        Route::get('/manage-courts/create', [TenantCourtController::class, 'create'])
            ->name('courts.manage.create');

        // Menyimpan Lapangan Baru
        Route::post('/manage-courts', [TenantCourtController::class, 'store'])
            ->name('courts.manage.store');

        // Form Edit Lapangan
        Route::get('/manage-courts/{court}/edit', [TenantCourtController::class, 'edit'])
            ->name('courts.manage.edit');

        // Memperbarui Data Lapangan
        Route::put('/manage-courts/{court}', [TenantCourtController::class, 'update'])
            ->name('courts.manage.update');

        // Menghapus Lapangan
        Route::delete('/manage-courts/{court}', [TenantCourtController::class, 'destroy'])
            ->name('courts.manage.destroy');

    });

});


/*
|--------------------------------------------------------------------------
| 6. PENGATURAN PENGGUNA
|--------------------------------------------------------------------------
*/

require __DIR__ . '/settings.php';
