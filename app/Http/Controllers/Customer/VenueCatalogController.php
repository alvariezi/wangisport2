<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenueCatalogController extends Controller
{
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
                'courts.id',
                'courts.name as court_name',
                'courts.type',
                'courts.surface_type',
                'courts.gambar',
                'tenants.display_name as tenant_name',
                'venues.name as venue_name',
                'venues.slug as venue_slug',
            ])
            ->first();

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
    
    public function index(Request $request)
    {
        $category = strtolower(trim((string) $request->query('category', 'all')));
        $search   = trim((string) $request->query('q', ''));

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

        // 1. Filter Kategori dropdown / pilihan cepat
        if ($category !== '' && $category !== 'all') {
            $normalizedCategory = str_replace(['-', '_'], ' ', $category);

            $query->where(function ($q) use ($category, $normalizedCategory) {
                $q->whereRaw('LOWER(courts.type) = ?', [$category])
                  ->orWhereRaw('LOWER(REPLACE(REPLACE(courts.type, "-", " "), "_", " ")) = ?', [$normalizedCategory]);
            });
        }

        // 2. Pencarian kata kunci 'q'
        if ($search !== '') {
            $sportKeywords = [
                'futsal',
                'badminton',
                'mini soccer',
                'mini-soccer',
                'padel',
                'basket',
                'tenis',
            ];

            $keywords = preg_split('/\s+/', strtolower($search), -1, PREG_SPLIT_NO_EMPTY);

            foreach ($keywords as $word) {
                $normalizedWord = str_replace(['-', '_'], ' ', $word);
                $likeWord = '%' . $normalizedWord . '%';

                // Jika kata yang diketik adalah nama olahraga (mis. 'futsal'),
                // cocokkan hanya dengan tipe olahraga/nama lapangan, bukan nama tenant/venue gabungan.
                if (in_array($word, $sportKeywords, true) || in_array($normalizedWord, $sportKeywords, true)) {
                    $query->where(function ($q) use ($word, $normalizedWord, $likeWord) {
                        $q->whereRaw('LOWER(courts.type) = ?', [$word])
                          ->orWhereRaw('LOWER(REPLACE(REPLACE(courts.type, "-", " "), "_", " ")) = ?', [$normalizedWord])
                          ->orWhereRaw('LOWER(courts.type) LIKE ?', [$likeWord])
                          ->orWhereRaw('LOWER(courts.name) LIKE ?', [$likeWord]);
                    });
                } else {
                    $query->where(function ($q) use ($likeWord) {
                        $q->whereRaw('LOWER(courts.name) LIKE ?', [$likeWord])
                          ->orWhereRaw('LOWER(COALESCE(courts.surface_type, "")) LIKE ?', [$likeWord])
                          ->orWhereRaw('LOWER(tenants.display_name) LIKE ?', [$likeWord])
                          ->orWhereRaw('LOWER(venues.name) LIKE ?', [$likeWord]);
                    });
                }
            }
        }

        $courts = $query
            ->orderBy('courts.type')
            ->orderBy('courts.id')
            ->paginate(6)
            ->withQueryString();

        $groupedCourts = $courts->getCollection()->groupBy(function ($item) {
            return strtolower(trim((string) $item->type)) ?: 'lainnya';
        });

        return view('customer.catalog', compact('courts', 'groupedCourts', 'category', 'search'));
    }
}