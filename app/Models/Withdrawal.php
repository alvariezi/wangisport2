<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use BelongsToTenant;

    protected $fillable = ['bank_account_id', 'requested_by', 'reviewed_by', 'idempotency_key', 'amount', 'status', 'transfer_snapshot', 'active_tenant_lock'];

    protected function casts(): array
    {
        return ['amount' => 'integer', 'transfer_snapshot' => 'array'];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
