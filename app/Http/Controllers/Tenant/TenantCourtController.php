<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantCourtController extends Controller
{
    /**
     * Menampilkan daftar lapangan milik tenant.
     */
    public function index()
    {
        $tenant = Tenant::first();

        $courts = $tenant
            ? Court::where('tenant_id', $tenant->id)
                ->latest()
                ->get()
            : collect();

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
     * Menyimpan lapangan baru beserta gambar.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'type' => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $tenant = Tenant::firstOrFail();

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')
                ->store('courts', 'public');
        }

        try {
            Court::create([
                'tenant_id' => $tenant->id,
                'name' => $validated['name'],
                'type' => $validated['type'],
                'surface_type' => $validated['surface_type'] ?? null,
                'gambar' => $gambar,
                'is_active' => $request->has('is_active'),
            ]);
        } catch (\Throwable $e) {
            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            throw $e;
        }

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit lapangan.
     */
    public function edit(Court $court)
    {
        $tenant = Tenant::firstOrFail();

        abort_unless($court->tenant_id == $tenant->id, 403);

        return view('tenant.courts.edit', compact('tenant', 'court'));
    }

    /**
     * Memperbarui lapangan dan gambar.
     */
    public function update(Request $request, Court $court)
    {
        $tenant = Tenant::firstOrFail();

        abort_unless($court->tenant_id == $tenant->id, 403);

        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'type' => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarLama = $court->gambar;
        $gambarBaru = null;

        if ($request->hasFile('gambar')) {
            $gambarBaru = $request->file('gambar')
                ->store('courts', 'public');
        }

        try {
            $court->update([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'surface_type' => $validated['surface_type'] ?? null,
                'gambar' => $gambarBaru ?? $gambarLama,
                'is_active' => $request->has('is_active'),
            ]);
        } catch (\Throwable $e) {
            if ($gambarBaru) {
                Storage::disk('public')->delete($gambarBaru);
            }

            throw $e;
        }

        if ($gambarBaru && $gambarLama) {
            Storage::disk('public')->delete($gambarLama);
        }

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Data lapangan berhasil diperbarui!');
    }

    /**
     * Menghapus lapangan beserta gambarnya.
     */
    public function destroy(Court $court)
    {
        $tenant = Tenant::firstOrFail();

        abort_unless($court->tenant_id == $tenant->id, 403);

        $gambar = $court->gambar;

        $court->delete();

        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()
            ->route('tenant.courts.manage')
            ->with('success', 'Lapangan berhasil dihapus!');
    }
}
