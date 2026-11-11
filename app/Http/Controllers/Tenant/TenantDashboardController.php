<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantDashboardController extends Controller
{
    public function index()
    {
        // Ambil data tenant yang dikelola oleh user yang sedang login
        $tenant = Tenant::with(['venue', 'activeCommissionScheme'])->first();
        
        $totalCourts = Court::where('tenant_id', $tenant?->id)->count();
        $activeCourts = Court::where('tenant_id', $tenant?->id)
                             ->where('is_active', true)
                             ->count();

        return view('tenant.dashboard', compact('tenant', 'totalCourts', 'activeCourts'));
    }
}