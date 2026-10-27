<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVenueRole extends Model
{
    protected $fillable = ['user_id', 'venue_id', 'role'];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
