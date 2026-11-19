<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminVenueController extends Controller
{
    /**
     * Tampilkan seluruh data venue arena (Read)
     */
    public function index()
    {
        $venues = Venue::withCount('tenants')->latest()->get();
        return view('admin.venues.index', compact('venues'));
    }

    /**
     * Tampilkan form penambahan venue baru
     */
    public function create()
    {
        return view('admin.venues.create');
    }

    /**
     * Simpan venue baru ke basis data (Store)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:150',
            'code'   => 'required|string|max:30|unique:venues,code',
            'status' => 'required|in:active,inactive,maintenance',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate slug otomatis dari nama venue (misal: "Saiki Sport Center" -> "saiki-sport-center")
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('venues', 'public');
        }

        Venue::create($validated);

        return redirect()->route('admin.venues.index')
            ->with('status', 'Venue arena baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit venue
     */
    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    /**
     * Perbarui data venue di basis data (Update)
     */
    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:150',
            'code'   => 'required|string|max:30|unique:venues,code,' . $venue->id,
            'status' => 'required|in:active,inactive,maintenance',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate slug otomatis dari nama venue yang diperbarui
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('gambar')) {
            $newPath = $request->file('gambar')->store('venues', 'public');
            if ($venue->gambar) {
                Storage::disk('public')->delete($venue->gambar);
            }
            $validated['gambar'] = $newPath;
        }

        $venue->update($validated);

        return redirect()->route('admin.venues.index')
            ->with('status', 'Data venue berhasil diperbarui!');
    }

    /**
     * Hapus venue dari basis data (Delete)
     */
    public function destroy(Venue $venue)
    {
        $gambar = $venue->gambar;
        $venue->delete();
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()->route('admin.venues.index')
            ->with('status', 'Venue arena berhasil dihapus!');
    }
}