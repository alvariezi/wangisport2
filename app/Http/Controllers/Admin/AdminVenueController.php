<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserTenantRole;
use Illuminate\Support\Facades\DB;
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
        $venues = Venue::withCount('courts')->latest()->get();
        return view('admin.venues.index', compact('venues'));
    }

    /**
     * Detail seluruh courts yang terkait dengan venue melalui tenant.
     */
    public function courts(Venue $venue)
    {
        $courts = $venue->courts()
            ->withoutGlobalScope('tenant')
            ->with('tenant')
            ->orderBy('name')
            ->get();

        return view('admin.venues.courts', compact('venue', 'courts'));
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
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:30|unique:venues,code',
            'status' => 'required|in:active,inactive,maintenance',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'operator_name' => 'required|string|max:255',
            'operator_email' => 'required|email|max:255|unique:users,email',
            'operator_password' => 'required|string|min:8|confirmed',
        ]);

        $slug = Str::slug($validated['name']);
        if (Venue::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'Nama menghasilkan slug yang sudah digunakan.'])->withInput();
        }

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('venues', 'public');
        }

        try {
            DB::transaction(function () use ($validated, $slug, $gambar) {
                // 1. Venue baru
                $venue = Venue::create([
                    'name' => $validated['name'],
                    'code' => $validated['code'],
                    'slug' => $slug,
                    'status' => $validated['status'],
                    'gambar' => $gambar,
                ]);

                // 2. Tenant pengelola otomatis terikat pada venue ini
                $tenant = Tenant::create([
                    'venue_id' => $venue->id,
                    'code' => 'TNT-' . $venue->id,
                    'slug' => 'tenant-' . $venue->id,
                    'display_name' => $venue->name,
                    'status' => $venue->status === 'active' ? 'active' : 'pending',
                ]);

                // 3. Akun login operator (password otomatis di-hash oleh model User)
                $operator = User::create([
                    'name' => $validated['operator_name'],
                    'email' => $validated['operator_email'],
                    'password' => $validated['operator_password'],
                    'role' => 'tenant',
                    'status' => 'active',
                ]);
                // Akun yang dibuat oleh super admin ditandai terverifikasi.
                $operator->forceFill(['email_verified_at' => now()])->save();

                // 4. Memberikan akses operator ke tenant yang baru dibuat
                UserTenantRole::create([
                    'user_id' => $operator->id,
                    'tenant_id' => $tenant->id,
                    'role' => 'owner',
                ]);
            });
        } catch (\Throwable $e) {
            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }
            throw $e;
        }

        return redirect()->route('admin.venues.index')
            ->with('status', 'Venue, tenant, dan akun operator berhasil didaftarkan!');
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