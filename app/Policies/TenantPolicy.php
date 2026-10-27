<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use App\Models\UserVenueRole;

class TenantPolicy
{
    private function managesVenue(User $user, int $venueId): bool
    {
        return UserVenueRole::query()->where('user_id', $user->id)->where('venue_id', $venueId)->whereIn('role', ['owner', 'manager', 'finance'])->exists();
    }

    public function viewAny(User $user): bool
    {
        return UserVenueRole::query()->where('user_id', $user->id)->exists() || $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return UserVenueRole::query()->where('user_id', $user->id)->whereIn('role', ['owner', 'manager'])->exists() || $user->isAdmin();
    }

    public function update(User $user, Tenant $tenant): bool
    {
        return $this->managesVenue($user, $tenant->venue_id) || $user->isAdmin();
    }

    public function scheduleCommission(User $user, Tenant $tenant): bool
    {
        return $this->managesVenue($user, $tenant->venue_id) || $user->isAdmin();
    }

    public function manageBank(User $user, Tenant $tenant): bool
    {
        return $this->managesVenue($user, $tenant->venue_id) || $user->isAdmin();
    }

    public function assignRole(User $user, Tenant $tenant): bool
    {
        return $this->managesVenue($user, $tenant->venue_id) || $user->isAdmin();
    }
}
