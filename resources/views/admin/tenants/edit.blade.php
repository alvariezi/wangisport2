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

    <div class="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
        <h2 class="mb-2 text-lg font-semibold dark:text-zinc-100">Hubungkan Akun Operator Tenant</h2>
        <p class="mb-4 text-sm text-zinc-500 dark:text-zinc-400">
            Operator yang ditugaskan di sini akan melihat venue dan courts milik tenant ini saat login.
            Buat akun dengan role <strong>tenant</strong> terlebih dahulu jika belum ada.
        </p>
        @if(session('status')) <p class="mb-3 text-sm text-emerald-500">{{ session('status') }}</p> @endif
        @if($errors->has('user_id')) <p class="mb-3 text-sm text-red-500">{{ $errors->first('user_id') }}</p> @endif
        <form method="POST" action="{{ route('admin.tenants.assign-operator', $tenant) }}" class="flex flex-wrap items-end gap-3">
            @csrf
            <div class="min-w-64 flex-1">
                <label for="user_id" class="mb-1 block text-xs font-semibold dark:text-zinc-200">Akun Tenant</label>
                <select id="user_id" name="user_id" required class="w-full rounded-xl border border-zinc-300 bg-white px-3 py-2 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white">
                    <option value="">-- Pilih akun operator --</option>
                    @foreach($operatorUsers as $operator)
                        <option value="{{ $operator->id }}" {{ in_array($operator->id, $assignedUserIds) ? 'selected' : '' }}>
                            {{ $operator->name }} ({{ $operator->email }}){{ in_array($operator->id, $assignedUserIds) ? ' — terhubung' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Hubungkan Operator</button>
        </form>
        @if(empty($assignedUserIds))
            <p class="mt-3 text-xs text-amber-500">Belum ada operator untuk tenant ini. Tenant tidak akan bisa membuka dashboard sampai ada penugasan.</p>
        @endif
    </div>
</x-layouts.admin>