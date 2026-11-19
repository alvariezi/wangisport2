<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeslot extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id', 'court_id', 'day_of_week', 'start_time', 'end_time',
        'base_price', 'is_peak_rate', 'is_available',
    ];

    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
            'base_price' => 'integer',
            'is_peak_rate' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }
}
