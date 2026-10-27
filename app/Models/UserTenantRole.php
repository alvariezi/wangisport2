<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTenantRole extends Model
{
    protected $fillable = ['user_id', 'tenant_id', 'role'];
}
