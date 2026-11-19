<x-layouts.admin title="Daftar Courts Venue">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('admin.venues.index') }}"
                   class="mb-3 inline-flex items-center gap-2 text-sm text-indigo-500 hover:text-indigo-400">
                    &larr; Kembali ke Daftar Venue
                </a>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">
                    Courts - {{ $venue->name }}
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Seluruh lapangan milik tenant yang terdaftar pada venue ini.
                </p>
            </div>
            <span class="inline-flex w-fit rounded-xl border border-indigo-500/20 bg-indigo-500/10 px-4 py-2 text-sm font-bold text-indigo-500">
                {{ $courts->count() }} Court
            </span>
        </div>

        <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-xs uppercase text-zinc-500 dark:bg-zinc-950/60 dark:text-zinc-400">
                        <tr>
                            <th class="px-5 py-4">Foto Lapangan</th>
                            <th class="px-5 py-4">Nama Court</th>
                            <th class="px-5 py-4">Tenant Pengelola</th>
                            <th class="px-5 py-4">Jenis</th>
                            <th class="px-5 py-4">Permukaan</th>
                            <th class="px-5 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse($courts as $court)
                            <tr class="hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40">
                                <td class="px-5 py-4">
                                    @if($court->gambar)
                                        <img src="{{ asset('storage/' . $court->gambar) }}"
                                             alt="{{ $court->name }}"
                                             class="h-16 w-24 rounded-lg object-cover">
                                    @else
                                        <span class="text-xs text-zinc-500">Belum ada foto</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 font-semibold text-zinc-900 dark:text-zinc-100">{{ $court->name }}</td>
                                <td class="px-5 py-4 text-zinc-600 dark:text-zinc-300">{{ $court->tenant?->display_name ?? '-' }}</td>
                                <td class="px-5 py-4 text-zinc-600 dark:text-zinc-300">{{ ucfirst($court->type) }}</td>
                                <td class="px-5 py-4 text-zinc-600 dark:text-zinc-300">{{ $court->surface_type ?: '-' }}</td>
                                <td class="px-5 py-4">
                                    @if($court->is_active)
                                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-500">Aktif</span>
                                    @else
                                        <span class="rounded-full bg-zinc-500/10 px-3 py-1 text-xs font-bold text-zinc-500">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-sm text-zinc-500">
                                    Belum ada court yang terdaftar pada venue ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
