<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use App\Models\Timeslot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantDashboardController extends Controller
{
    public function index()
    {
        $tenantId = DB::table('user_tenant_roles')
            ->where('user_id', Auth::id())
            ->value('tenant_id');
        abort_unless($tenantId, 403, 'Akun Anda belum ditugaskan ke tenant.');

        $tenant = Tenant::with('venue')->findOrFail($tenantId);
        $courts = Court::where('tenant_id', $tenant->id)
            ->withAvg('timeslots as average_price', 'base_price')
            ->withMin('timeslots as min_price', 'base_price')
            ->withMax('timeslots as max_price', 'base_price')
            ->orderBy('name')->get();

        $totalCourts = $courts->count();
        $activeCourts = $courts->where('is_active', true)->count();
        $prices = Timeslot::where('tenant_id', $tenant->id)
            ->whereIn('court_id', $courts->pluck('id'));
        $overallAveragePrice = (int) round((clone $prices)->avg('base_price') ?? 0);
        $lowestPrice = (int) ((clone $prices)->min('base_price') ?? 0);
        $highestPrice = (int) ((clone $prices)->max('base_price') ?? 0);
        $priceChart = $courts->map(fn ($court) => [
            'name' => $court->name,
            'average_price' => (int) round($court->average_price ?? 0),
        ]);
        $chartMax = max(1, (int) $priceChart->max('average_price'));

        return view('tenant.dashboard', compact(
            'tenant', 'courts', 'totalCourts', 'activeCourts',
            'overallAveragePrice', 'lowestPrice', 'highestPrice', 'priceChart', 'chartMax'
        ));
    }
}
