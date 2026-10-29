<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        ]);

        // Generate slug otomatis dari nama venue (misal: "Saiki Sport Center" -> "saiki-sport-center")
        $validated['slug'] = Str::slug($validated['name']);

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
        ]);

        // Generate slug otomatis dari nama venue yang diperbarui
        $validated['slug'] = Str::slug($validated['name']);

        $venue->update($validated);

        return redirect()->route('admin.venues.index')
            ->with('status', 'Data venue berhasil diperbarui!');
    }

    /**
     * Hapus venue dari basis data (Delete)
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('admin.venues.index')
            ->with('status', 'Venue arena berhasil dihapus!');
    }
}