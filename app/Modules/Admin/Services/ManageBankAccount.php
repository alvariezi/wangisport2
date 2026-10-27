<?php

namespace App\Modules\Admin\Services;

use App\Models\Tenant;
use App\Models\TenantBankAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class ManageBankAccount
{
    public function __construct(private AuditLogger $audit) {}

    public function store(Tenant $tenant, array $data): TenantBankAccount
    {
        return DB::transaction(function () use ($tenant, $data): TenantBankAccount {
            $account = (new TenantBankAccount)->forceFill(['tenant_id' => $tenant->id, 'bank_code' => $data['bank_code'], 'account_holder' => $data['account_holder'], 'account_last4' => Str::substr((string) $data['account_number'], -4), 'account_number_cipher' => (string) $data['account_number'], 'status' => 'unverified', 'is_primary' => false]);
            $account->save();
            $this->audit->record('tenant_bank_account', $account->id, 'created', null, ['bank_code' => $data['bank_code'], 'account_last4' => $account->account_last4], $tenant->id, $tenant->venue_id);

            return $account;
        });
    }

    public function verify(TenantBankAccount $account, bool $approve): void
    {
        $account->forceFill(['status' => $approve ? 'verified' : 'rejected'])->save();
        $this->audit->record('tenant_bank_account', $account->id, $approve ? 'verified' : 'rejected', null, ['status' => $account->status], $account->tenant_id);
    }

    public function makePrimary(TenantBankAccount $account): void
    {
        DB::transaction(function () use ($account): void {
            TenantBankAccount::query()->where('tenant_id', $account->tenant_id)->whereKeyNot($account->id)->update(['is_primary' => false]);
            $account->forceFill(['is_primary' => true])->save();
        });
    }
}
