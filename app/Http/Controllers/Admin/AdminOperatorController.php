<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminOperatorController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        // Satu baris per relasi operator-tenant, supaya venue pengelola jelas.
        $operators = DB::table('user_tenant_roles as utr')
            ->join('users as u', 'u.id', '=', 'utr.user_id')
            ->join('tenants as t', 't.id', '=', 'utr.tenant_id')
            ->join('venues as v', 'v.id', '=', 't.venue_id')
            ->where('u.role', 'tenant')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('u.name', 'like', "%{$search}%")
                      ->orWhere('u.email', 'like', "%{$search}%")
                      ->orWhere('v.name', 'like', "%{$search}%")
                      ->orWhere('t.display_name', 'like', "%{$search}%");
                });
            })
            ->select([
                'utr.id as assignment_id', 'utr.role as assignment_role',
                'u.id as user_id', 'u.name as operator_name',
                'u.email', 'u.status as user_status',
                't.display_name as tenant_name', 'v.name as venue_name',
            ])
            ->orderBy('v.name')->orderBy('u.name')
            ->paginate(15)->withQueryString();

        return view('admin.operators.index', compact('operators', 'search'));
    }

    public function edit(User $user)
    {
        abort_unless($user->role === 'tenant', 404);

        $assignments = DB::table('user_tenant_roles as utr')
            ->join('tenants as t', 't.id', '=', 'utr.tenant_id')
            ->join('venues as v', 'v.id', '=', 't.venue_id')
            ->where('utr.user_id', $user->id)
            ->select('v.name as venue_name', 't.display_name as tenant_name', 'utr.role')
            ->get();

        abort_if($assignments->isEmpty(), 404);

        return view('admin.operators.edit', compact('user', 'assignments'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless($user->role === 'tenant', 404);
        abort_unless(DB::table('user_tenant_roles')->where('user_id', $user->id)->exists(), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->status = $validated['status'];
        if (!empty($validated['password'])) {
            // Model User sudah memiliki cast password => hashed.
            $user->password = $validated['password'];
        }
        $user->save();

        return redirect()->route('admin.operators.index')
            ->with('status', 'Akun operator berhasil diperbarui.');
    }
}
