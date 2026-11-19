<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTenantController extends Controller
{
    /**
     * Tampilkan daftar tenant mitra (Index)
     */
    public function index()
    {
        $tenants = Tenant::with('venue')->latest()->get();
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Tampilkan form penambahan tenant baru (Create Form)
     */
    public function create()
    {
        $venues = Venue::where('status', 'active')->get();
        return view('admin.tenants.create', compact('venues'));
    }

    /**
     * Simpan tenant baru ke basis data (Store)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'venue_id'     => 'required|exists:venues,id',
            'code'         => 'required|string|max:30|unique:tenants,code',
            'slug'         => 'required|string|max:100|unique:tenants,slug',
            'display_name' => 'required|string|max:120',
            'status'       => 'required|in:pending,active,suspended,inactive',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tenants', 'public');
        }

        Tenant::create($validated);

        return redirect()->route('admin.tenants.index')
            ->with('status', 'Tenant mitra baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit tenant (Edit Form)
     */
    public function edit(Tenant $tenant)
    {
        $venues = Venue::all();
        return view('admin.tenants.edit', compact('tenant', 'venues'));
    }

    /**
     * Perbarui data tenant di basis data (Update)
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'venue_id'     => 'required|exists:venues,id',
            'code'         => 'required|string|max:30|unique:tenants,code,' . $tenant->id,
            'slug'         => 'required|string|max:100|unique:tenants,slug,' . $tenant->id,
            'display_name' => 'required|string|max:120',
            'status'       => 'required|in:pending,active,suspended,inactive',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $oldImage = $tenant->gambar;
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tenants', 'public');
        } else {
            unset($validated['gambar']);
        }

        $tenant->update($validated);

        if ($request->hasFile('gambar') && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.tenants.index')
            ->with('status', 'Data tenant berhasil diperbarui!');
    }

    /**
     * Hapus tenant dari basis data (Delete)
     */
    public function destroy(Tenant $tenant)
    {
        $gambar = $tenant->gambar;
        $tenant->delete();

        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()->route('admin.tenants.index')
            ->with('status', 'Tenant mitra berhasil dihapus!');
    }
}