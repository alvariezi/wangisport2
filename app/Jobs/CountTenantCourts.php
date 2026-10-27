<?php

namespace App\Jobs;

use App\Models\Court;
use App\Models\Tenant;
use App\Support\Tenancy\TenantContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CountTenantCourts implements ShouldQueue
{
    use Queueable;

    public ?int $result = null;

    public function __construct(public int $tenantId) {}

    public function handle(TenantContext $context): void
    {
        $tenant = Tenant::query()->findOrFail($this->tenantId);
        $context->set($tenant);
        try {
            $this->result = Court::query()->count();
        } finally {
            $context->clear();
        }
    }
}
