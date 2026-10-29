<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionScheme;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCommissionController extends Controller
{
    /**
     * Tampilkan daftar komisi aktif dan riwayat
     */
    public function index()
    {
        $globalCommission = CommissionScheme::whereNull('tenant_id')
            ->whereNull('valid_to')
            ->latest('valid_from')
            ->first();

        $tenants = Tenant::with(['activeCommissionScheme', 'venue'])->get();

        $history = CommissionScheme::with('tenant')
            ->latest('valid_from')
            ->paginate(15);

        return view('admin.commissions.index', compact('globalCommission', 'tenants', 'history'));
    }

    /**
     * Tampilkan form penambahan skema komisi baru
     */
    public function create()
    {
        $tenants = Tenant::where('status', 'active')->get();
        return view('admin.commissions.create', compact('tenants'));
    }

    /**
     * Simpan skema komisi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'       => 'nullable|exists:tenants,id',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'notes'           => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $now = now();
            $tenantId = $validated['tenant_id'] ?? null;

            CommissionScheme::where('tenant_id', $tenantId)
                ->whereNull('valid_to')
                ->update(['valid_to' => $now]);

            CommissionScheme::create([
                'tenant_id'       => $tenantId,
                'commission_rate' => $validated['commission_rate'],
                'valid_from'      => $now,
                'valid_to'        => null,
                'notes'           => $validated['notes'] ?? 'Atur skema komisi baru',
            ]);
        });

        return redirect()->route('admin.commissions.index')
            ->with('status', 'Skema komisi baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit komisi
     */
    public function edit(CommissionScheme $commission)
    {
        return view('admin.commissions.edit', compact('commission'));
    }

    /**
     * Perbarui data komisi
     */
    public function update(Request $request, CommissionScheme $commission)
    {
        $validated = $request->validate([
            'commission_rate' => 'required|numeric|min:0|max:100',
            'notes'           => 'nullable|string|max:255',
        ]);

        $commission->update([
            'commission_rate' => $validated['commission_rate'],
            'notes'           => $validated['notes'],
        ]);

        return redirect()->route('admin.commissions.index')
            ->with('status', 'Tarif komisi berhasil diperbarui!');
    }
}