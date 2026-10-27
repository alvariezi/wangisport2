<?php

namespace App\Modules\Admin\Services;

use App\Models\CommissionScheme;
use App\Models\Tenant;
use App\Models\TenantBalance;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

final class CreateTenant
{
    public function __construct(private AuditLogger $audit, private ManageBankAccount $bankAccounts, private AssignTenantRole $roles) {}

    public function handle(Venue $venue, array $data): Tenant
    {
        return DB::transaction(function () use ($venue, $data): Tenant {
            $tenant = (new Tenant)->forceFill(['venue_id' => $venue->id, 'code' => $data['code'], 'slug' => $data['slug'], 'display_name' => $data['display_name'], 'status' => 'active']);
            $tenant->save();
            (new TenantBalance)->forceFill(['tenant_id' => $tenant->id, 'available_amount' => 0, 'held_amount' => 0])->save();
            $commission = (new CommissionScheme)->forceFill(['tenant_id' => $tenant->id, 'commission_rate' => $data['commission_rate'], 'valid_from' => now(), 'valid_to' => null]);
            $commission->save();
            $this->audit->record('tenant', $tenant->id, 'created', null, $tenant->only(['code', 'slug', 'display_name', 'status']), $tenant->id, $venue->id);
            $this->audit->record('commission_scheme', $commission->id, 'created', null, $commission->only(['commission_rate', 'valid_from']), $tenant->id, $venue->id);
            if (isset($data['pic_email'])) {
                $owner = (new User)->forceFill(['name' => $data['pic_name'], 'email' => $data['pic_email'], 'password' => Str::password(32), 'role' => 'tenant', 'status' => 'active', 'email_verified_at' => now()]);
                $owner->save();
                $this->roles->assign($tenant, $owner, 'owner');
                DB::afterCommit(fn () => Password::broker()->sendResetLink(['email' => $owner->email]));
            }if (isset($data['account_number'])) {
                $this->bankAccounts->store($tenant, $data)->forceFill(['is_primary' => true])->save();
            }

return $tenant;
        });
    }
}
