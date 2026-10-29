<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionScheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'commission_rate',
        'valid_from',
        'valid_to',
        'notes',
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    /**
     * Relasi ke Tenant (Opsional: null jika komisi global/default platform)
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Scope untuk mengambil skema komisi yang sedang aktif
     */
    public function scopeActive($query)
    {
        return $query->whereNull('valid_to')
            ->where('valid_from', '<=', now());
    }
}