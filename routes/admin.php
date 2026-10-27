<?php

use App\Models\CommissionScheme;
use App\Models\Tenant;
use App\Models\Venue;
use App\Support\Routing\PortalRoutes;
use Illuminate\Support\Facades\Route;

PortalRoutes::admin(function (): void {
    Route::get('/dashboard', function () {
        // 1. Ambil data statistik dari database
        $totalVenues = Venue::query()->count();
        $totalTenants = Tenant::query()->count();
        $activeTenants = Tenant::query()->where('status', 'active')->count();

        // 2. Ambil tarif komisi aktif terbaru (default)
        $latestCommission = CommissionScheme::query()
            ->whereNull('valid_to')
            ->latest('valid_from')
            ->value('commission_rate') ?? 15.00;

        // 3. Ambil daftar venue beserta tenant mitranya
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
});