<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantCourtController extends Controller
{
    /**
     * Menampilkan daftar lapangan milik tenant.
     */
    public function index()
    {
        $tenant = Tenant::first();

        $courts = Court::where('tenant_id', $tenant?->id)
            ->latest()
            ->get();

        return view('tenant.courts.index', compact('tenant', 'courts'));
    }

    /**
     * Menampilkan halaman tambah lapangan.
     */
    public function create()
    {
        $tenant = Tenant::first();

        return view('tenant.courts.create', compact('tenant'));
    }

    /**
     * Menyimpan data lapangan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:120',
            'type'         => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
        ]);

        $tenant = Tenant::first();

        Court::create([
            'tenant_id'   => $tenant?->id ?? 1,
            'name'        => $validated['name'],
            'type'        => $validated['type'],
            'surface_type' => $validated['surface_type'] ?? null,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit lapangan.
     */
    public function edit(Court $court)
    {
        $tenant = Tenant::first();

        return view('tenant.courts.edit', compact('tenant', 'court'));
    }

    /**
     * Memperbarui data lapangan.
     */
    public function update(Request $request, Court $court)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:120',
            'type'         => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
        ]);

        $court->update([
            'name'         => $validated['name'],
            'type'         => $validated['type'],
            'surface_type' => $validated['surface_type'] ?? null,
            'is_active'    => $request->has('is_active'),
        ]);

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Data lapangan berhasil diperbarui!');
    }

    /**
     * Menghapus data lapangan.
     */
    public function destroy(Court $court)
    {
        $court->delete();

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Lapangan berhasil dihapus!');
    }
}
