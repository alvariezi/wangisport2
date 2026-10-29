<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'code',
        'slug',
        'display_name',
        'status',
    ];

    /**
     * Relasi BelongsTo ke Venue Induk (Satu Tenant terikat pada satu Venue)
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Relasi HasMany ke seluruh riwayat skema komisi tenant
     */
    public function commissionSchemes(): HasMany
    {
        return $this->hasMany(CommissionScheme::class);
    }

    /**
     * Relasi HasOne ke skema komisi khusus yang sedang aktif saat ini
     */
    public function activeCommissionScheme(): HasOne
    {
        return $this->hasOne(CommissionScheme::class)
            ->whereNull('valid_to')
            ->latestOfMany('valid_from');
    }
}