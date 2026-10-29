<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'slug', // <--- Pastikan 'slug' ada di sini
        'status',
    ];

    /**
     * Relasi HasMany ke Tenant
     */
    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }
}