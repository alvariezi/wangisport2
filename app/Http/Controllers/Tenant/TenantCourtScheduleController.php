<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Tenant;
use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantCourtScheduleController extends Controller
{
    private function tenant(): Tenant
    {
        $tenantId = DB::table('user_tenant_roles')
            ->where('user_id', Auth::id())
            ->value('tenant_id');
        abort_unless($tenantId, 403, 'Akun belum dihubungkan dengan tenant.');
        return Tenant::findOrFail($tenantId);
    }

    private function guard(Court $court): Tenant
    {
        $tenant = $this->tenant();
        abort_unless((int) $court->tenant_id === (int) $tenant->id, 403);
        return $tenant;
    }

    public function index(Court $court)
    {
        $tenant = $this->guard($court);
        $timeslots = Timeslot::where('tenant_id', $tenant->id)
            ->where('court_id', $court->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        return view('tenant.courts.schedule', compact('tenant', 'court', 'timeslots'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'day_of_week' => 'required|integer|between:1,7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'base_price' => 'required|integer|min:0|max:999999999999',
            'is_peak_rate' => 'sometimes|boolean',
            'is_available' => 'sometimes|boolean',
        ]);
    }

    private function validateOverlap(Court $court, array $data, ?Timeslot $except = null): void
    {
        $overlap = Timeslot::where('tenant_id', $court->tenant_id)
            ->where('court_id', $court->id)
            ->where('day_of_week', $data['day_of_week'])
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time'])
            ->when($except, fn ($query) => $query->where('id', '!=', $except->id))
            ->exists();
        if ($overlap) {
            throw ValidationException::withMessages([
                'start_time' => 'Jam tersebut bertabrakan dengan jadwal lain pada hari yang sama.',
            ]);
        }
    }

    public function store(Request $request, Court $court)
    {
        $tenant = $this->guard($court);
        $data = $this->validated($request);
        $this->validateOverlap($court, $data);
        Timeslot::create([
            'tenant_id' => $tenant->id,
            'court_id' => $court->id,
            'day_of_week' => $data['day_of_week'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'base_price' => $data['base_price'],
            'is_peak_rate' => $request->boolean('is_peak_rate'),
            'is_available' => $request->boolean('is_available'),
        ]);
        return back()->with('success', 'Jadwal dan harga berhasil ditambahkan.');
    }

    public function update(Request $request, Court $court, Timeslot $timeslot)
    {
        $this->guard($court);
        abort_unless(
            (int) $timeslot->tenant_id === (int) $court->tenant_id &&
            (int) $timeslot->court_id === (int) $court->id, 404
        );
        $data = $this->validated($request);
        $this->validateOverlap($court, $data, $timeslot);
        $timeslot->update([
            'day_of_week' => $data['day_of_week'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'base_price' => $data['base_price'],
            'is_peak_rate' => $request->boolean('is_peak_rate'),
            'is_available' => $request->boolean('is_available'),
        ]);
        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Court $court, Timeslot $timeslot)
    {
        $this->guard($court);
        abort_unless(
            (int) $timeslot->tenant_id === (int) $court->tenant_id &&
            (int) $timeslot->court_id === (int) $court->id, 404
        );
        $timeslot->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
