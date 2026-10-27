<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeslot extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = ['court_id', 'start_time', 'end_time', 'base_price', 'is_peak_rate', 'is_available'];

    protected function casts(): array
    {
        return ['base_price' => 'integer', 'is_peak_rate' => 'boolean', 'is_available' => 'boolean'];
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
