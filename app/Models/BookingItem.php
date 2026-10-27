<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingItem extends Model
{
    use BelongsToTenant;

    protected $fillable = ['court_booking_id', 'court_id', 'timeslot_id', 'court_name_snapshot', 'start_time_snapshot', 'end_time_snapshot', 'price_snapshot'];

    protected function casts(): array
    {
        return ['price_snapshot' => 'integer'];
    }

    public function courtBooking(): BelongsTo
    {
        return $this->belongsTo(CourtBooking::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }
}
