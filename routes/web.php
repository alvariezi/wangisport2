
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLER SUPER ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AdminCommissionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOperatorController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminVenueController;

/*
|--------------------------------------------------------------------------
| CONTROLLER CUSTOMER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\CustomerHomeController;
use App\Http\Controllers\Customer\VenueCatalogController;

/*
|--------------------------------------------------------------------------
| CONTROLLER TENANT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Tenant\TenantDashboardController;
use App\Http\Controllers\Tenant\TenantCourtController;
use App\Http\Controllers\Tenant\TenantCourtScheduleController;


/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK
|--------------------------------------------------------------------------
*/

// Halaman utama Wangisport
Route::get(
    '/',
    [CustomerHomeController::class, 'index']
)->name('home');


/*
|--------------------------------------------------------------------------
| DETAIL LAPANGAN (FITUR BARU)
|--------------------------------------------------------------------------
|
| Ketika pelanggan mengklik card lapangan,
| sistem akan membuka detail lapangan beserta
| foto, informasi venue, jam tersedia, dan harga.
|
*/

Route::get(
    '/lapangan/{court}',
    [VenueCatalogController::class, 'showCourt']
)
    ->whereNumber('court')
    ->name('customer.courts.show');


/*
|--------------------------------------------------------------------------
| KATALOG SEWA LAPANGAN
|--------------------------------------------------------------------------
*/

// Halaman daftar seluruh lapangan
Route::get(
    '/sewa-lapangan',
    [VenueCatalogController::class, 'index']
)->name('customer.catalog');


// Detail venue berdasarkan slug
Route::get(
    '/venues/{venue:slug}',
    [VenueCatalogController::class, 'showVenue']
)->name('venues.show');


// Detail tenant pada venue
Route::get(
    '/venues/{venue:slug}/tenants/{tenant:slug}',
    [VenueCatalogController::class, 'showTenant']
)->name('tenants.show');


// Cek ketersediaan jadwal
Route::get(
    '/availability',
    [VenueCatalogController::class, 'checkAvailability']
)->name('availability.check');


/*
|--------------------------------------------------------------------------
| 2. ROUTE PENGGUNA LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | REDIRECT DASHBOARD BERDASARKAN ROLE
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

            // Dashboard Customer
            Route::get(
                '/dashboard',
                [CustomerHomeController::class, 'index']
            )->name('dashboard');

            // Katalog lapangan
            Route::get(
                '/sewa-lapangan',
                [VenueCatalogController::class, 'index']
            )->name('catalog');

            // Proses booking
            Route::post(
                '/booking/process',
                [BookingController::class, 'process']
            )->name('booking.process');

            // Daftar pesanan
            Route::get(
                '/orders',
                [BookingController::class, 'index']
            )->name('orders.index');

            // Detail pesanan
            Route::get(
                '/orders/{orderNumber}',
                [BookingController::class, 'show']
            )->name('orders.show');
        });


    /*
    |--------------------------------------------------------------------------
    | 4. PORTAL SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->middleware('role:admin')
        ->name('admin.')
        ->group(function () {

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

            // Menampilkan courts berdasarkan venue
            Route::get(
                '/venues/{venue}/courts',
                [AdminVenueController::class, 'courts']
            )->name('venues.courts');

            // CRUD Venue
            Route::resource(
                'venues',
                AdminVenueController::class
            );


            /*
            |--------------------------------------------------------------------------
            | MANAJEMEN OPERATOR VENUE
            |--------------------------------------------------------------------------
            */

            // Daftar operator
            Route::get(
                '/operators',
                [AdminOperatorController::class, 'index']
            )->name('operators.index');

            // Form edit operator
            Route::get(
                '/operators/{user}/edit',
                [AdminOperatorController::class, 'edit']
            )->name('operators.edit');

            // Update operator
            Route::put(
                '/operators/{user}',
                [AdminOperatorController::class, 'update']
            )->name('operators.update');


            /*
            |--------------------------------------------------------------------------
            | MANAJEMEN TENANT
            |--------------------------------------------------------------------------
            */

            // CRUD Tenant
            Route::resource(
                'tenants',
                AdminTenantController::class
            );

            // Menghubungkan akun operator ke tenant
            Route::post(
                '/tenants/{tenant}/assign-operator',
                [AdminTenantController::class, 'assignOperator']
            )->name('tenants.assign-operator');


            /*
            |--------------------------------------------------------------------------
            | ROUTE KOMISI LAMA
            |--------------------------------------------------------------------------
            |
            | Tetap tersedia untuk kompatibilitas
            | tetapi tidak ditampilkan pada sidebar.
            |
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

        });


    /*
    |--------------------------------------------------------------------------
    | 5. PORTAL TENANT MITRA
    |--------------------------------------------------------------------------
    */

    Route::prefix('tenant')
        ->middleware('role:tenant')
        ->name('tenant.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | DASHBOARD TENANT
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/dashboard',
                [TenantDashboardController::class, 'index']
            )->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | MANAJEMEN COURTS / LAPANGAN
            |--------------------------------------------------------------------------
            */

            // Daftar lapangan
            Route::get(
                '/manage-courts',
                [TenantCourtController::class, 'index']
            )->name('courts.manage');

            // Form tambah lapangan
            Route::get(
                '/manage-courts/create',
                [TenantCourtController::class, 'create']
            )->name('courts.manage.create');

            // Simpan lapangan
            Route::post(
                '/manage-courts',
                [TenantCourtController::class, 'store']
            )->name('courts.manage.store');

            // Form edit lapangan
            Route::get(
                '/manage-courts/{court}/edit',
                [TenantCourtController::class, 'edit']
            )->name('courts.manage.edit');

            // Update lapangan
            Route::put(
                '/manage-courts/{court}',
                [TenantCourtController::class, 'update']
            )->name('courts.manage.update');

            // Hapus lapangan
            Route::delete(
                '/manage-courts/{court}',
                [TenantCourtController::class, 'destroy']
            )->name('courts.manage.destroy');


            /*
            |--------------------------------------------------------------------------
            | PENGATURAN JADWAL & HARGA LAPANGAN
            |--------------------------------------------------------------------------
            */

            // Halaman pengaturan jadwal
            Route::get(
                '/courts/{court}/schedule',
                [TenantCourtScheduleController::class, 'index']
            )->name('courts.schedule');

            // Tambah jadwal dan harga
            Route::post(
                '/courts/{court}/schedule',
                [TenantCourtScheduleController::class, 'store']
            )->name('courts.schedule.store');

            // Update jadwal dan harga
            Route::put(
                '/courts/{court}/schedule/{timeslot}',
                [TenantCourtScheduleController::class, 'update']
            )->name('courts.schedule.update');

            // Hapus jadwal
            Route::delete(
                '/courts/{court}/schedule/{timeslot}',
                [TenantCourtScheduleController::class, 'destroy']
            )->name('courts.schedule.destroy');

        });

});


/*
|--------------------------------------------------------------------------
| 6. PENGATURAN PENGGUNA
|--------------------------------------------------------------------------
*/

require __DIR__ . '/settings.php';
