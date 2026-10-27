<?php

namespace App\Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TenantCourtController extends Controller
{
    use AuthorizesRequests;

    public function index(Tenant $tenant): JsonResponse
    {
        $courts = Court::query()->orderBy('name')->get();

        return response()->json(['tenant' => $tenant->slug, 'courts' => $courts]);
    }

    public function show(Tenant $tenant, Court $court): JsonResponse
    {
        $this->authorize('view', $court);

        return response()->json($court);
    }

    public function update(Request $request, Tenant $tenant, Court $court): JsonResponse
    {
        $this->authorize('update', $court);
        $data = $request->validate(['is_active' => ['required', 'boolean']]);
        $court->update(['is_active' => $data['is_active']]);

        return response()->json(['ok' => true, 'court' => $court]);
    }
}
