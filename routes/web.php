
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

        return redirect()->route('customer.home');

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

            // Checkout
            Route::get('/booking/checkout', [BookingController::class, 'checkout'])
                ->name('booking.checkout');

            // Proses pemesanan
            Route::post('/booking/process', [BookingController::class, 'process'])
                ->name('booking.process');

            // Riwayat pemesanan
            Route::get('/orders', [BookingController::class, 'index'])
                ->name('orders.index');

            // Detail pemesanan
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

            // Dashboard Admin
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
    | 5. PORTAL TENANT MITRA
    |--------------------------------------------------------------------------
    */

    Route::prefix('tenant')
        ->name('tenant.')
        ->group(function () {

            // Dashboard Tenant
            Route::get('/dashboard', [TenantDashboardController::class, 'index'])
                ->name('dashboard');

        });

});


/*
|--------------------------------------------------------------------------
| 6. PENGATURAN PENGGUNA
|--------------------------------------------------------------------------
*/

require __DIR__.'/settings.php';
