<x-layouts.admin title="Dashboard Super Admin">
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Super Admin Platform</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Pantau pertumbuhan dan pengelolaan venue Wangisport dari database.</p>
            </div>
            <a href="{{ route('admin.venues.create') }}"
               class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-indigo-500">
                + Tambah Venue
            </a>
        </div>

        {{-- Kartu statistik real-time dari MariaDB --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Venue Terdaftar</p>
                <p class="mt-2 text-3xl font-extrabold text-zinc-900 dark:text-white">{{ number_format($totalVenues, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Seluruh venue yang terdaftar</p>
            </div>
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Venue Aktif</p>
                <p class="mt-2 text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($activeVenues, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Venue dengan status aktif</p>
            </div>
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Tenant Aktif</p>
                <p class="mt-2 text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ number_format($activeTenants, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Mitra yang berstatus aktif</p>
            </div>
        </div>

        {{-- Grafik tanpa library eksternal, tidak bergantung pada CDN --}}
        <section id="grafik-venue" class="scroll-mt-20 rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 sm:p-6">
            <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-zinc-900 dark:text-zinc-100">Grafik Pendaftaran Venue</h2>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Jumlah venue baru per bulan selama 12 bulan terakhir, berdasarkan tanggal pendaftaran di database.</p>
                </div>
                <span class="mt-2 inline-flex w-fit rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300 sm:mt-0">12 Bulan Terakhir</span>
            </div>

            <div class="mt-7 overflow-x-auto pb-2">
                <div class="min-w-[660px]">
                    <div class="relative h-56 border-b border-zinc-200 dark:border-zinc-700">
                        {{-- Garis bantu horizontal --}}
                        <div class="pointer-events-none absolute inset-0 flex flex-col justify-between">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="border-t border-dashed border-zinc-200 dark:border-zinc-800"></div>
                            @endfor
                        </div>
                        <div class="relative z-[1] grid h-full grid-cols-12 items-end gap-3 px-2">
                            @foreach ($chartMonths as $item)
                                @php
                                    $height = $item['total'] > 0 ? max(7, ($item['total'] / $chartMax) * 100) : 0;
                                @endphp
                                <div class="flex h-full flex-col items-center justify-end" title="{{ $item['month'] }}: {{ $item['total'] }} venue baru">
                                    <span class="mb-2 text-[11px] font-bold text-zinc-700 dark:text-zinc-300">{{ $item['total'] }}</span>
                                    <div class="w-full max-w-10 rounded-t-lg bg-indigo-500 transition-colors hover:bg-indigo-400 dark:bg-indigo-400"
                                         style="height: {{ $height }}%;" aria-label="{{ $item['month'] }}: {{ $item['total'] }} venue baru" role="img"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-3 px-2 pt-3">
                        @foreach ($chartMonths as $item)
                            <div class="text-center text-[10px] font-medium text-zinc-500 dark:text-zinc-400">{{ $item['label'] }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">Grafik menunjukkan venue baru, bukan total kumulatif. Kartu Total Venue menampilkan seluruh venue terdaftar.</p>
        </section>

        {{-- Daftar venue dan tenant, tanpa kolom komisi --}}
        <section class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex flex-col gap-2 border-b border-zinc-200 px-6 py-4 dark:border-zinc-800 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-zinc-900 dark:text-zinc-100">Venue & Tenant Mitra Terdaftar</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Daftar diambil langsung dari database Wangisport.</p>
                </div>
                <a href="{{ route('admin.venues.index') }}" class="text-xs font-bold text-indigo-600 hover:underline dark:text-indigo-400">Lihat semua venue</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Venue</th>
                            <th class="px-6 py-3 font-semibold">Tenant Mitra</th>
                            <th class="px-6 py-3 font-semibold">Status Venue</th>
                            <th class="px-6 py-3 font-semibold">Tanggal Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse ($venues as $venue)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-zinc-900 dark:text-zinc-100">{{ $venue->name }}</div>
                                    <div class="text-xs font-mono text-zinc-500">{{ $venue->code }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @forelse ($venue->tenants as $tenant)
                                        <div class="text-xs font-medium text-zinc-800 dark:text-zinc-200">{{ $tenant->display_name }}</div>
                                    @empty
                                        <span class="text-xs italic text-zinc-400">Belum ada tenant</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4">
                                    @if ($venue->status === 'active')
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Aktif</span>
                                    @else
                                        <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-bold text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">{{ ucfirst($venue->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-500 dark:text-zinc-400">{{ $venue->created_at?->format('d/m/Y') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-zinc-500">Belum ada venue. Tambahkan venue melalui menu Tambah Venue.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-layouts.admin>
