<?php

namespace App\Support\Tenancy;

use App\Models\Tenant;
use App\Models\UserTenantRole;
use Illuminate\Support\Facades\Auth;

/** Tenant yang benar-benar ditugaskan Super Admin ke akun yang login. */
final class CurrentTenant
{
    public function get(): Tenant
    {
        abort_unless(Auth::check() && Auth::user()->hasRole('tenant'), 403);

        $ids = UserTenantRole::query()
            ->where('user_id', Auth::id())
            ->distinct()
            ->pluck('tenant_id');

        abort_if($ids->isEmpty(), 403, 'Akun Anda belum ditugaskan ke tenant. Hubungi Super Admin.');
        abort_if($ids->count() > 1, 403, 'Akun terhubung ke beberapa tenant. Minta Super Admin menetapkan satu tenant untuk portal ini.');

        $tenant = Tenant::with(['venue', 'activeCommissionScheme'])->findOrFail($ids->first());
        abort_unless($tenant->status === 'active', 403, 'Tenant belum aktif.');
        abort_unless($tenant->venue && $tenant->venue->status === 'active', 403, 'Venue tenant belum aktif.');

        return $tenant;
    }
}
