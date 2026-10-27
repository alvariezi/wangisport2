<?php

namespace App\Policies;

use App\Models\Court;
use App\Models\User;
use App\Support\Tenancy\TenantContext;

class CourtPolicy
{
    private function ownedByActiveTenant(Court $court): bool
    {
        return $court->tenant_id === app(TenantContext::class)->idOrNull();
    }

    public function view(User $user, Court $court): bool
    {
        return $this->ownedByActiveTenant($court);
    }

    public function update(User $user, Court $court): bool
    {
        return $this->ownedByActiveTenant($court);
    }

    public function delete(User $user, Court $court): bool
    {
        return $this->ownedByActiveTenant($court);
    }
}
