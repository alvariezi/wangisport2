<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenueCatalogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search   = $request->query('q');

        $query = DB::table('courts')
            ->join('tenants', 'courts.tenant_id', '=', 'tenants.id')
            ->join('venues', 'tenants.venue_id', '=', 'venues.id')
            ->leftJoin('timeslots', function ($join) {
                $join->on('courts.id', '=', 'timeslots.court_id')
                     ->where('timeslots.is_available', 1);
            })
            ->where('courts.is_active', 1)
            ->where('tenants.status', 'active')
            ->where('venues.status', 'active')
            ->select([
                'courts.id',
                'courts.name as court_name',
                'courts.type',
                'courts.surface_type',
                'courts.gambar',
                'tenants.display_name as tenant_name',
                'venues.name as venue_name',
                'venues.slug as venue_slug',
                DB::raw('MIN(timeslots.base_price) as starting_price'),
            ])
            ->groupBy(
                'courts.id',
                'courts.name',
                'courts.type',
                'courts.surface_type',
                'courts.gambar',
                'tenants.display_name',
                'venues.name',
                'venues.slug'
            );

        if (!empty($category) && $category !== 'all') {
            $query->whereRaw('LOWER(courts.type) = ?', [strtolower($category)]);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('courts.name', 'like', '%' . $search . '%')
                  ->orWhere('tenants.display_name', 'like', '%' . $search . '%')
                  ->orWhere('venues.name', 'like', '%' . $search . '%');
            });
        }

        $courts = $query->orderBy('courts.id')->paginate(6)->withQueryString();

        return view('customer.catalog', compact('courts', 'category', 'search'));
    }

    /** Halaman detail publik satu lapangan dan jadwal tersedia. */
    public function showCourt(int $court)
    {
        $courtData = DB::table('courts')
            ->join('tenants', 'courts.tenant_id', '=', 'tenants.id')
            ->join('venues', 'tenants.venue_id', '=', 'venues.id')
            ->where('courts.id', $court)
            ->where('courts.is_active', 1)
            ->where('tenants.status', 'active')
            ->where('venues.status', 'active')
            ->select([
                'courts.id', 'courts.name as court_name', 'courts.type',
                'courts.surface_type', 'courts.gambar',
                'tenants.display_name as tenant_name',
                'venues.name as venue_name', 'venues.slug as venue_slug',
            ])->first();

        abort_unless($courtData, 404);

        $timeslots = DB::table('timeslots')
            ->where('court_id', $courtData->id)
            ->where('is_available', 1)
            ->orderByRaw('CASE WHEN day_of_week IS NULL THEN 8 ELSE day_of_week END')
            ->orderBy('start_time')
            ->get(['id', 'day_of_week', 'start_time', 'end_time', 'base_price']);

        $startingPrice = $timeslots->min('base_price');

        return view('customer.courts.show', compact('courtData', 'timeslots', 'startingPrice'));
    }
}