<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddOn extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = ['name', 'price', 'stock_qty', 'is_available'];

    protected function casts(): array
    {
        return ['price' => 'integer', 'stock_qty' => 'integer', 'is_available' => 'boolean'];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
