<x-layouts.admin title="Edit Tenant Mitra">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Edit Data Tenant</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Perbarui informasi tenant mitra {{ $tenant->display_name }}</p>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <form action="{{ route('admin.tenants.update', $tenant) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Pilihan Venue -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Venue Arena</label>
                    <select name="venue_id" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        @foreach ($venues as $venue)
                            <option value="{{ $venue->id }}" {{ old('venue_id', $tenant->venue_id) == $venue->id ? 'selected' : '' }}>
                                {{ $venue->name }} ({{ $venue->code }})
                            </option>
                        @endforeach
                    </select>
                    @error('venue_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama Tenant -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Nama Tampilan Tenant</label>
                    <input type="text" name="display_name" value="{{ old('display_name', $tenant->display_name) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                    @error('display_name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kode & Slug -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Kode Unique</label>
                        <input type="text" name="code" value="{{ old('code', $tenant->code) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm font-mono dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        @error('code')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $tenant->slug) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm font-mono dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        @error('slug')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Status Operasional</label>
                    <select name="status" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <option value="active" {{ old('status', $tenant->status) === 'active' ? 'selected' : '' }}>Active (Aktif)</option>
                        <option value="pending" {{ old('status', $tenant->status) === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="suspended" {{ old('status', $tenant->status) === 'suspended' ? 'selected' : '' }}>Suspended (Ditangguhkan)</option>
                        <option value="inactive" {{ old('status', $tenant->status) === 'inactive' ? 'selected' : '' }}>Inactive (Non-Aktif)</option>
                    </select>
                    @error('status')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.tenants.index') }}" class="rounded-xl bg-zinc-100 px-4 py-2.5 text-xs font-semibold text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">
                        Batal
                    </a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-500">
                        Perbarui Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>