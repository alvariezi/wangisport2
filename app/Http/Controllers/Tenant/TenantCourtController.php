<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Support\Tenancy\CurrentTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantCourtController extends Controller
{
    public function index(CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        $courts = Court::query()->where('tenant_id', $tenant->id)->latest()->get();
        return view('tenant.courts.index', compact('tenant', 'courts'));
    }

    public function create(CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        return view('tenant.courts.create', compact('tenant'));
    }

    public function store(Request $request, CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'type' => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('courts', 'public') : null;

        try {
            Court::create([
                'tenant_id' => $tenant->id,
                'name' => $validated['name'],
                'type' => $validated['type'],
                'surface_type' => $validated['surface_type'] ?? null,
                'gambar' => $path,
                'is_active' => $request->boolean('is_active'),
            ]);
        } catch (\Throwable $e) {
            if ($path) Storage::disk('public')->delete($path);
            throw $e;
        }

        return redirect()->route('tenant.courts.manage')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    public function edit(Court $court, CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        abort_unless((int) $court->tenant_id === (int) $tenant->id, 404);
        return view('tenant.courts.edit', compact('tenant', 'court'));
    }

    public function update(Request $request, Court $court, CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        abort_unless((int) $court->tenant_id === (int) $tenant->id, 404);
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'type' => 'required|string|in:futsal,badminton,basket,padel,tenis',
            'surface_type' => 'nullable|string|max:60',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $oldPath = $court->gambar;
        $newPath = $request->hasFile('gambar')
            ? $request->file('gambar')->store('courts', 'public') : null;

        try {
            $court->update([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'surface_type' => $validated['surface_type'] ?? null,
                'gambar' => $newPath ?? $oldPath,
                'is_active' => $request->boolean('is_active'),
            ]);
        } catch (\Throwable $e) {
            if ($newPath) Storage::disk('public')->delete($newPath);
            throw $e;
        }
        if ($newPath && $oldPath) Storage::disk('public')->delete($oldPath);

        return redirect()->route('tenant.courts.manage')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function destroy(Court $court, CurrentTenant $currentTenant)
    {
        $tenant = $currentTenant->get();
        abort_unless((int) $court->tenant_id === (int) $tenant->id, 404);
        $path = $court->gambar;
        $court->delete();
        if ($path) Storage::disk('public')->delete($path);
        return redirect()->route('tenant.courts.manage')->with('success', 'Lapangan berhasil dihapus!');
    }
}
