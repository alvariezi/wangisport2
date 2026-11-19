<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gambar',
        'code',
        'slug',
        'status',
    ];

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    // courts.tenant_id -> tenants.id -> tenants.venue_id -> venues.id
    public function courts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Court::class,
            Tenant::class,
            'venue_id',
            'tenant_id',
            'id',
            'id'
        );
    }
}
