<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionScheme extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = ['commission_rate', 'valid_from', 'valid_to'];

    protected function casts(): array
    {
        return ['commission_rate' => 'decimal:4', 'valid_from' => 'datetime', 'valid_to' => 'datetime'];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** * Scope untuk menyaring skema komisi yang berlaku pada kurun waktu tertentu. */
    #[Scope]
    protected function effectiveAt(Builder $query, CarbonInterface $instant): void
    {
        $query->where('valid_from', '<=', $instant)->where(function (Builder $query) use ($instant): void {
            $query->whereNull('valid_to')->orWhere('valid_to', '>', $instant);
        });
    }
}
