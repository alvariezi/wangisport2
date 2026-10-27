<x-layouts.admin title="Dashboard Super Admin">
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Super Admin Platform</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    Ringkasan performa dan manajemen venue mitra Wangisport
                </p>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> System Normal
                </span>
            </div>
        </div>

        <!-- Kartu Statistik Utama Dinamis -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- Card 1: Total Venue & Tenant Mitra -->
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Total Venue / Tenant
                </p>
                <p class="mt-2 text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">
                    {{ $totalVenues }} <span class="text-lg font-normal text-zinc-500">Venue</span>
                </p>
                <p class="mt-1 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                    ✓ {{ $activeTenants }} Tenant Aktif Terdaftar
                </p>
            </div>

            <!-- Card 2: Skema Komisi Default -->
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Skema Komisi Aktif
                </p>
                <p class="mt-2 text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">
                    {{ number_format((float) $latestCommission, 2) }}%
                </p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    Effective-Dated Enabled
                </p>
            </div>

            <!-- Card 3: Keamanan Tenancy -->
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Isolasi Multi-Tenant
                </p>
                <p class="mt-2 text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">
                    Terisolasi
                </p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    4 Layer Guard Active
                </p>
            </div>
        </div>

        <!-- Tabel Daftar Venue & Tenant Mitra -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                <h2 class="text-base font-bold text-zinc-900 dark:text-zinc-100">
                    Daftar Venue & Tenant Mitra Terdaftar
                </h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">Data ini diambil langsung secara real-time dari basis data MariaDB</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Kode & Nama Venue</th>
                            <th class="px-6 py-3 font-semibold">Tenant Mitra</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                            <th class="px-6 py-3 font-semibold">Tarif Pajak / Layanan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse ($venues as $venue)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-zinc-900 dark:text-zinc-100">{{ $venue->name }}</div>
                                    <div class="text-xs font-mono text-zinc-500">{{ $venue->code }} (slug: {{ $venue->slug }})</div>
                                </td>
                                <td class="px-6 py-4">
                                    @forelse ($venue->tenants as $tenant)
                                        <div class="font-medium text-zinc-800 dark:text-zinc-200">
                                            • {{ $tenant->display_name }}
                                        </div>
                                        <div class="text-xs font-mono text-zinc-500 pl-3">
                                            Code: {{ $tenant->code }}
                                        </div>
                                    @empty
                                        <span class="text-xs italic text-zinc-400">Belum ada tenant</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4">
                                    @if ($venue->status === 'active')
                                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-semibold text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-zinc-600 dark:text-zinc-400">
                                    Tax: {{ number_format($venue->tax_rate * 100, 1) }}% | Service: {{ number_format($venue->service_fee_rate * 100, 1) }}%
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-zinc-500">
                                    Belum ada data venue. Jalankan <code class="bg-zinc-100 px-1 py-0.5 rounded text-zinc-800">php artisan db:seed</code> untuk mengisi data demo.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>