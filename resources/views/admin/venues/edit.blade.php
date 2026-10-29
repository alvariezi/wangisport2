<x-layouts.admin title="Edit Venue Arena">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Edit Data Venue</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Perbarui informasi venue {{ $venue->name }}</p>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <form action="{{ route('admin.venues.update', $venue) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Venue -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Nama Venue Arena</label>
                    <input type="text" name="name" value="{{ old('name', $venue->name) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kode Unique -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Kode Unique Venue</label>
                    <input type="text" name="code" value="{{ old('code', $venue->code) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm font-mono dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status Operasional -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Status Operasional</label>
                    <select name="status" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <option value="active" {{ old('status', $venue->status) === 'active' ? 'selected' : '' }}>Active (Aktif)</option>
                        <option value="maintenance" {{ old('status', $venue->status) === 'maintenance' ? 'selected' : '' }}>Maintenance (Pemeliharaan)</option>
                        <option value="inactive" {{ old('status', $venue->status) === 'inactive' ? 'selected' : '' }}>Inactive (Non-Aktif)</option>
                    </select>
                    @error('status')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.venues.index') }}" class="rounded-xl bg-zinc-100 px-4 py-2.5 text-xs font-semibold text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">Batal</a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-500">Perbarui Venue</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>