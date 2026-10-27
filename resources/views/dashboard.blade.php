@php
    use App\Models\Venue;
    use App\Models\Tenant;
    use App\Models\CommissionScheme;

    // Fetch data langsung dari database
    $totalVenues = Venue::query()->count();
    $totalTenants = Tenant::query()->count();
    $activeTenants = Tenant::query()->where('status', 'active')->count();
    $latestCommission = CommissionScheme::query()
        ->whereNull('valid_to')
        ->latest('valid_from')
        ->value('commission_rate') ?? 15.00;
    $venues = Venue::with('tenants')->get();
@endphp

<x-layouts.admin title="Dashboard Super Admin Platform">
    <div class="space-y-8">
        <!-- 1. Hero Welcome Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-zinc-900 via-indigo-950 to-zinc-900 p-6 sm:p-8 text-white shadow-xl">
            <!-- Background Decorative Blur Grid -->
            <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute right-1/3 -bottom-10 h-48 w-48 rounded-full bg-emerald-500/10 blur-2xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-indigo-200 backdrop-blur-md mb-3 border border-white/10">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Wangisport Multi-Client Backoffice
                    </div>
                    <h1 class="text-2xl font-extrabold sm:text-3xl tracking-tight text-white">
                        Portal Administrasi Platform
                    </h1>
                    <p class="mt-1 max-w-xl text-sm text-zinc-300">
                        Kelola venue mitra, pemantauan skema komisi <em>effective-dated</em>, isolasi <em>multi-tenant</em>, dan jejak audit terenkripsi.
                    </p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ request()->url() }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Refresh Data
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. Kartu Statistik Ringkasan -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Metric 1: Venue -->
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Venue</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/80 dark:text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-black text-zinc-900 dark:text-zinc-100">{{ $totalVenues }}</span>
                    <span class="text-xs text-zinc-500">Lokasi</span>
                </div>
                <div class="mt-2 flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400">
                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $totalVenues }} Arena Terverifikasi
                </div>
            </div>

            <!-- Metric 2: Tenant Mitra -->
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Tenant Mitra</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/80 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-black text-zinc-900 dark:text-zinc-100">{{ $totalTenants }}</span>
                    <span class="text-xs text-zinc-500">Unit Pengelola</span>
                </div>
                <div class="mt-2 flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-500 mr-1.5"></span>
                    {{ $activeTenants }} Status Aktif
                </div>
            </div>

            <!-- Metric 3: Skema Komisi -->
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Komisi Platform</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/80 dark:text-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-black text-zinc-900 dark:text-zinc-100">{{ number_format((float) $latestCommission, 2) }}%</span>
                </div>
                <div class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                    Effective-Dated Versi Aktif
                </div>
            </div>

            <!-- Metric 4: Keamanan Tenancy -->
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Isolasi Data</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-950/80 dark:text-sky-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-2xl font-black text-emerald-600 dark:text-emerald-400">Terisolasi</span>
                </div>
                <div class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                    4-Layer Context Guard
                </div>
            </div>
        </div>

        <!-- 3. Tabel Data Venue & Tenant Mitra -->
        <div class="overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <!-- Header Tabel -->
            <div class="flex flex-col gap-4 border-b border-zinc-200/80 px-6 py-5 sm:flex-row sm:items-center sm:justify-between dark:border-zinc-800">
                <div>
                    <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">
                        Daftar Venue & Tenant Mitra
                    </h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        Data real-time terhubung langsung ke basis data MariaDB Wangisport
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-zinc-100 px-3 py-1.5 text-xs font-semibold text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                        <svg class="w-3.5 h-3.5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                        Total: {{ $venues->count() }} Venue
                    </span>
                </div>
            </div>

            <!-- Tabel Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-200/80 bg-zinc-50/70 text-xs uppercase tracking-wider text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950/50 dark:text-zinc-400">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold">Venue Arena</th>
                            <th class="px-6 py-3.5 font-semibold">Tenant Pengelola</th>
                            <th class="px-6 py-3.5 font-semibold">Status Operasional</th>
                            <th class="px-6 py-3.5 font-semibold">Tarif Pajak & Layanan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800">
                        @forelse ($venues as $venue)
                            <tr class="transition-colors hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40">
                                <!-- Kolom Venue -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-sm font-bold text-white shadow-md shadow-indigo-500/20">
                                            {{ strtoupper(substr($venue->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-zinc-900 dark:text-zinc-100">{{ $venue->name }}</div>
                                            <div class="flex items-center gap-2 text-xs text-zinc-500">
                                                <span class="rounded bg-zinc-100 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">{{ $venue->code }}</span>
                                                <span>/ {{ $venue->slug }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kolom Tenant -->
                                <td class="px-6 py-4">
                                    @forelse ($venue->tenants as $tenant)
                                        <div class="flex items-center gap-2">
                                            <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                            <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $tenant->display_name }}</span>
                                        </div>
                                        <div class="pl-3.5 text-xs text-zinc-500 font-mono">
                                            Code: {{ $tenant->code }}
                                        </div>
                                    @empty
                                        <span class="text-xs italic text-zinc-400">Belum ada tenant</span>
                                    @endforelse
                                </td>

                                <!-- Kolom Status -->
                                <td class="px-6 py-4">
                                    @if ($venue->status === 'active')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-950/60 dark:text-emerald-300">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Aktif Beroperasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700 ring-1 ring-inset ring-zinc-500/20 dark:bg-zinc-800 dark:text-zinc-300">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>

                                <!-- Kolom Tax & Service Fee -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3 text-xs font-mono">
                                        <span class="rounded-md bg-zinc-100 px-2 py-1 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                            Pajak: <strong>{{ number_format($venue->tax_rate * 100, 1) }}%</strong>
                                        </span>
                                        <span class="rounded-md bg-zinc-100 px-2 py-1 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                            Layanan: <strong>{{ number_format($venue->service_fee_rate * 100, 1) }}%</strong>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-zinc-500">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                        <svg class="h-6 w-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="mt-3 font-medium text-zinc-900 dark:text-zinc-100">Belum ada data venue terdaftar.</p>
                                    <p class="mt-1 text-xs text-zinc-500">
                                        Jalankan <code class="rounded bg-zinc-100 px-1 py-0.5 font-mono text-zinc-800 dark:bg-zinc-800 dark:text-zinc-200">php artisan db:seed</code> di terminal.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>