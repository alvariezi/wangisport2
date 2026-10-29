<x-layouts.admin title="Skema Komisi Platform & Tenant">
    <div class="space-y-6">
        @if (session('status'))
            <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                ✓ {{ session('status') }}
            </div>
        @endif

        <!-- Header Title & Action Button -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Skema Komisi Platform</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Atur persentase bagi hasil/komisi untuk platform dan tenant mitra</p>
            </div>
            <div>
                <a href="{{ route('admin.commissions.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Atur Tarif Komisi Baru
                </a>
            </div>
        </div>

        <!-- Cards Informasi Komisi Global -->
        <div class="rounded-2xl border border-indigo-500/20 bg-indigo-500/5 p-6 dark:bg-indigo-950/20">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Komisi Default Platform (Global)</span>
                    <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-zinc-100 mt-1">
                        {{ $globalCommission ? number_format($globalCommission->commission_rate, 2) . '%' : '15.00%' }}
                    </h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Berlaku untuk semua tenant yang tidak memiliki komisi khusus</p>
                </div>
                <div>
                    @if ($globalCommission)
                        <a href="{{ route('admin.commissions.edit', $globalCommission) }}" class="inline-flex items-center gap-1.5 rounded-xl bg-indigo-600/10 px-3.5 py-2 text-xs font-semibold text-indigo-600 hover:bg-indigo-600/20 dark:text-indigo-400">
                            Edit Komisi Global
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Komisi Per Tenant -->
        <div class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200/80 px-6 py-4 dark:border-zinc-800">
                <h3 class="font-bold text-zinc-900 dark:text-zinc-100">Status Komisi Spesifik Tenant</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50/70 text-xs uppercase tracking-wider text-zinc-500 dark:bg-zinc-950/50 dark:text-zinc-400">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold">Nama Tenant</th>
                            <th class="px-6 py-3.5 font-semibold">Venue Induk</th>
                            <th class="px-6 py-3.5 font-semibold">Tarif Komisi Aktif</th>
                            <th class="px-6 py-3.5 font-semibold">Mulai Berlaku</th>
                            <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800">
                        @forelse ($tenants as $tenant)
                            <tr class="transition-colors hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4 font-bold text-zinc-900 dark:text-zinc-100">
                                    {{ $tenant->display_name }}
                                </td>
                                <td class="px-6 py-4 text-zinc-600 dark:text-zinc-400">
                                    {{ $tenant->venue?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 font-bold text-indigo-600 dark:text-indigo-400">
                                    @if ($tenant->activeCommissionScheme)
                                        {{ number_format($tenant->activeCommissionScheme->commission_rate, 2) }}%
                                        <span class="ml-1.5 rounded bg-indigo-50 px-2 py-0.5 text-[10px] text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300">Khusus</span>
                                    @else
                                        {{ number_format($globalCommission->commission_rate ?? 15, 2) }}%
                                        <span class="ml-1.5 rounded bg-zinc-100 px-2 py-0.5 text-[10px] text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">Global</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-500">
                                    {{ $tenant->activeCommissionScheme?->valid_from ? $tenant->activeCommissionScheme->valid_from->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if ($tenant->activeCommissionScheme)
                                        <a href="{{ route('admin.commissions.edit', $tenant->activeCommissionScheme) }}" class="rounded-lg bg-zinc-100 px-3 py-1.5 text-xs font-semibold text-zinc-700 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">
                                            Edit
                                        </a>
                                    @else
                                        <a href="{{ route('admin.commissions.create') }}" class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-950 dark:text-indigo-400">
                                            + Set Khusus
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Belum ada data tenant.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>