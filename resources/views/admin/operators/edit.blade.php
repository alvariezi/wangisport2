<x-layouts.admin title="Edit Operator Venue">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.operators.index') }}" class="text-sm text-indigo-400 hover:underline">← Kembali ke Manajemen Operator</a>
            <h1 class="mt-3 text-2xl font-extrabold">Kelola Akun Operator</h1>
            <p class="mt-1 text-sm text-zinc-400">Perubahan akun berlaku untuk semua venue yang ditugaskan kepada operator ini.</p>
        </div>
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">
            <h2 class="mb-3 font-semibold">Venue yang Dikelola</h2>
            @foreach($assignments as $assignment)
                <p class="py-1 text-sm text-zinc-300">{{ $assignment->venue_name }} — {{ $assignment->tenant_name }} ({{ $assignment->role }})</p>
            @endforeach
        </div>
        <form action="{{ route('admin.operators.update', $user) }}" method="POST" class="space-y-5 rounded-2xl border border-zinc-800 bg-zinc-900 p-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="mb-1 block text-sm font-semibold">Nama Operator</label>
                <input id="name" name="name" required maxlength="255" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm" />
                @error('name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="email" class="mb-1 block text-sm font-semibold">Email Login</label>
                <input id="email" name="email" type="email" required value="{{ old('email', $user->email) }}" class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm" />
                @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="status" class="mb-1 block text-sm font-semibold">Status Akun</label>
                <select id="status" name="status" required class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm">
                    <option value="active" @selected(old('status', $user->status) === 'active')>Aktif</option>
                    <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Nonaktif (tidak bisa mengakses portal)</option>
                </select>
                @error('status')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>
            <div class="border-t border-zinc-800 pt-5">
                <h2 class="mb-1 font-semibold">Reset Password (Opsional)</h2>
                <p class="mb-3 text-xs text-zinc-400">Biarkan kosong bila password tidak ingin diubah. Minimal 8 karakter.</p>
                <label for="password" class="mb-1 block text-sm">Password Baru</label>
                <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" class="mb-3 w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm" />
                <label for="password_confirmation" class="mb-1 block text-sm">Konfirmasi Password Baru</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm" />
                @error('password')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.operators.index') }}" class="rounded-xl bg-zinc-800 px-5 py-3 text-sm font-semibold">Batal</a>
                <button class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-500">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
