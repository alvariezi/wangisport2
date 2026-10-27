<?php

namespace App\Modules\Catalog\Services;

use App\Models\Court;
use App\Models\Venue;
use Illuminate\Support\Collection;

final class PublicCatalogQuery
{
    /** * Kueri publik lintas-tenant yang SAH. * Global scope bypass dilakukan secara EKSPLISIT lalu diganti dengan filter venue & status aktif. * * @return Collection<int, Court> */
    public function forVenue(Venue $venue): Collection
    {
        return Court::query()->withoutGlobalScope('tenant')->where('is_active', true)->whereHas('tenant', function ($query) use ($venue): void {
            $query->where('venue_id', $venue->id)->where('status', 'active');
        })->orderBy('name')->get();
    }
}
