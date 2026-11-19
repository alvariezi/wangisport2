<x-layouts.admin title="Tambah Venue Baru">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Tambah Venue Baru</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Daftarkan lokasi arena olahraga baru ke platform Wangisport</p>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <form action="{{ route('admin.venues.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama Venue -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Nama Venue Arena</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Siliwangi Sports Center" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kode Unique -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Kode Unique Venue</label>
                    <input type="text" name="code" value="{{ old('code') }}" required placeholder="VNU-SILIWANGI" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm font-mono dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar Venue -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Foto Venue (JPG/PNG/WebP, maksimal 2 MB)</label>
                    <input type="file" name="gambar" accept="image/jpeg,image/png,image/webp" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('gambar')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status Operasional -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Status Operasional</label>
                    <select name="status" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active (Aktif)</option>
                        <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance (Pemeliharaan)</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive (Non-Aktif)</option>
                    </select>
                    @error('status')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Akun login untuk pengelola venue -->
                <div class="border-t border-zinc-200 pt-5 mt-6 dark:border-zinc-700 space-y-4">
                    <div>
                        <h2 class="text-base font-bold text-zinc-900 dark:text-white">Akun Login Operator Venue</h2>
                        <p class="text-xs text-zinc-500">Akun ini digunakan untuk masuk ke Dashboard Tenant dan mengelola Courts pada venue baru.</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Nama Operator</label>
                        <input type="text" name="operator_name" value="{{ old('operator_name') }}" required maxlength="255" autocomplete="name" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100" placeholder="Contoh: Operator Saiki">
                        @error('operator_name')<span class="text-xs text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Email Login Tenant</label>
                        <input type="email" name="operator_email" value="{{ old('operator_email') }}" required maxlength="255" autocomplete="off" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100" placeholder="operator@example.com">
                        @error('operator_email')<span class="text-xs text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Password Awal</label>
                        <input type="password" name="operator_password" required minlength="8" autocomplete="new-password" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100" placeholder="Minimal 8 karakter">
                        @error('operator_password')<span class="text-xs text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Konfirmasi Password</label>
                        <input type="password" name="operator_password_confirmation" required minlength="8" autocomplete="new-password" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100" placeholder="Ulangi password">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.venues.index') }}" class="rounded-xl bg-zinc-100 px-4 py-2.5 text-xs font-semibold text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">Batal</a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-500">Simpan Venue</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>