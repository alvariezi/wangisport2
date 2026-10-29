<x-layouts.admin title="Manajemen Tenant Mitra">
    <div class="space-y-6">
        <!-- Notification Status -->
        @if (session('status'))
            <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                ✓ {{ session('status') }}
            </div>
        @endif

        <!-- Header Title & Action Button -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Daftar Tenant Mitra</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Kelola unit pengelola venue terdaftar pada platform Wangisport</p>
            </div>
            <div>
                <a href="{{ route('admin.tenants.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Tenant Baru
                </a>
            </div>
        </div>

        <!-- Tabel Data Tenant -->
        <div class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-200/80 bg-zinc-50/70 text-xs uppercase tracking-wider text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950/50 dark:text-zinc-400">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold">Nama Tenant</th>
                            <th class="px-6 py-3.5 font-semibold">Kode / Slug</th>
                            <th class="px-6 py-3.5 font-semibold">Venue Induk</th>
                            <th class="px-6 py-3.5 font-semibold">Status</th>
                            <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800">
                        @forelse ($tenants as $tenant)
                            <tr class="transition-colors hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4 font-bold text-zinc-900 dark:text-zinc-100">
                                    {{ $tenant->display_name }}
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-zinc-600 dark:text-zinc-400">
                                    <span class="rounded bg-zinc-100 px-1.5 py-0.5 dark:bg-zinc-800">{{ $tenant->code }}</span>
                                    <span class="text-zinc-400">/ {{ $tenant->slug }}</span>
                                </td>
                                <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300">
                                    {{ $tenant->venue?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($tenant->status === 'active')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-950/60 dark:text-emerald-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-semibold text-zinc-700 ring-1 ring-inset ring-zinc-500/20 dark:bg-zinc-800 dark:text-zinc-300">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.tenants.edit', $tenant) }}" class="rounded-lg bg-zinc-100 px-3 py-1.5 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tenant ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 dark:bg-red-950/50 dark:text-red-400 dark:hover:bg-red-900/50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-zinc-500">
                                    Belum ada tenant mitra terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>