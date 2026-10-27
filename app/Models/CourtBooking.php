<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourtBooking extends Model
{
    use BelongsToTenant;

    protected $fillable = ['order_id', 'commission_id', 'status', 'booking_date', 'commission_rate_snapshot', 'subtotal_amount', 'commission_amount', 'net_amount'];

    protected function casts(): array
    {
        return ['booking_date' => 'date', 'commission_rate_snapshot' => 'decimal:4', 'subtotal_amount' => 'integer', 'commission_amount' => 'integer', 'net_amount' => 'integer'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function commissionScheme(): BelongsTo
    {
        return $this->belongsTo(CommissionScheme::class, 'commission_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }
}
