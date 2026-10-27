<?php

namespace Tests\Feature;

use App\Jobs\CountTenantCourts;
use App\Models\Court;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserTenantRole;
use App\Models\Venue;
use App\Modules\Catalog\Services\PublicCatalogQuery;
use App\Policies\CourtPolicy;
use App\Support\Tenancy\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantIsolationTest extends TestCase
{
    use RefreshDatabase;

    private function tenantWithCourts(int $count, ?Venue $venue = null, string $status = 'active'): array
    {
        $venue ??= Venue::factory()->create();
        $tenant = Tenant::factory()->create(['venue_id' => $venue->id, 'status' => $status]);
        $courts = Court::factory()->count($count)->create(['tenant_id' => $tenant->id]);

        return [$tenant, $courts];
    }

    private function memberOf(Tenant $tenant): User
    {
        $user = User::factory()->create(['role' => 'tenant', 'status' => 'active', 'email_verified_at' => now()]);
        UserTenantRole::create(['user_id' => $user->id, 'tenant_id' => $tenant->id, 'role' => 'operator']);

        return $user;
    }

    public function test_global_scope_returns_only_active_tenant_rows(): void
    {
        [$a] = $this->tenantWithCourts(2);
        $this->tenantWithCourts(3);
        app(TenantContext::class)->set($a);
        $this->assertSame(2, Court::query()->count());
        $this->assertTrue(Court::query()->get()->every(fn (Court $c) => $c->tenant_id === $a->id));
    }

    public function test_scoped_binding_blocks_cross_tenant_court_access(): void
    {
        [$a] = $this->tenantWithCourts(1);
        [, $courtsB] = $this->tenantWithCourts(1);
        $courtB = $courtsB->first();
        $this->actingAs($this->memberOf($a));
        $this->getJson(route('tenant.courts.show', ['tenant' => $a->slug, 'court' => $courtB->id]))->assertNotFound();
    }

    public function test_policy_denies_cross_tenant_update(): void
    {
        [$a] = $this->tenantWithCourts(0);
        [, $courtsB] = $this->tenantWithCourts(1);
        $courtB = $courtsB->first();
        app(TenantContext::class)->set($a);
        $this->assertFalse((new CourtPolicy)->update(new User, $courtB));
    }

    public function test_public_catalog_query_filters_by_venue_and_active_tenant(): void
    {
        $venue1 = Venue::factory()->create();
        $this->tenantWithCourts(2, $venue1);
        $this->tenantWithCourts(1, $venue1, status: 'suspended');
        $venue2 = Venue::factory()->create();
        $this->tenantWithCourts(4, $venue2);
        $courts = app(PublicCatalogQuery::class)->forVenue($venue1);
        $this->assertCount(2, $courts);
    }

    public function test_job_sets_and_clears_context_per_tenant(): void
    {
        [$a] = $this->tenantWithCourts(2);
        [$b] = $this->tenantWithCourts(3);
        $jobA = new CountTenantCourts($a->id);
        $jobA->handle(app(TenantContext::class));
        $this->assertSame(2, $jobA->result);
        $this->assertFalse(app(TenantContext::class)->has());
        $jobB = new CountTenantCourts($b->id);
        $jobB->handle(app(TenantContext::class));
        $this->assertSame(3, $jobB->result);
    }
}
