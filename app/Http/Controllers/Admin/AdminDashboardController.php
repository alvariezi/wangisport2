<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Venue;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total venue terdaftar
        $totalVenues = Venue::count();

        // Total venue aktif
        $activeVenues = Venue::where(
            'status',
            'active'
        )->count();

        // Total tenant aktif
        $activeTenants = Tenant::where(
            'status',
            'active'
        )->count();

        // Total seluruh tenant
        $totalTenants = Tenant::count();

        // Daftar venue beserta tenant
        $venues = Venue::with('tenants')
            ->latest()
            ->get();

        // Data grafik 12 bulan terakhir
        $startMonth = now()
            ->startOfMonth()
            ->subMonths(11);

        $monthlyCounts = Venue::where(
                'created_at',
                '>=',
                $startMonth
            )
            ->selectRaw(
                "DATE_FORMAT(created_at, '%Y-%m') as month_key,
                 COUNT(*) as total"
            )
            ->groupByRaw(
                "DATE_FORMAT(created_at, '%Y-%m')"
            )
            ->pluck('total', 'month_key');

        $chartMonths = collect(range(0, 11))
            ->map(function ($index) use (
                $startMonth,
                $monthlyCounts
            ) {
                $month = $startMonth->copy()
                    ->addMonths($index);

                $key = $month->format('Y-m');

                return [
                    'label' => $month
                        ->locale('id')
                        ->translatedFormat('M y'),

                    'month' => $key,

                    'total' => (int) (
                        $monthlyCounts[$key] ?? 0
                    ),
                ];
            });

        // Skala maksimal grafik
        $chartMax = max(
            1,
            $chartMonths->max('total')
        );

        return view('admin.dashboard', compact(
            'totalVenues',
            'activeVenues',
            'activeTenants',
            'totalTenants',
            'venues',
            'chartMonths',
            'chartMax'
        ));
    }
}
