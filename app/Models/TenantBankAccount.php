<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantBankAccount extends Model
{
    protected $fillable = ['bank_code', 'account_holder', 'account_last4', 'status', 'is_primary'];

    protected function casts(): array
    {
        return ['account_number_cipher' => 'encrypted', 'is_primary' => 'boolean'];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
