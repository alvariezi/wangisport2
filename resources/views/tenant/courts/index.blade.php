@extends('layouts.tenant')

@section('title', 'Kelola Lapangan')

@section('content')

    <div class="space-y-6">

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div
                class="flex items-center gap-2 rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-xs font-semibold text-emerald-400">

                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                </svg>

                <span>{{ session('success') }}</span>

            </div>
        @endif


        <!-- Header Title & Tombol Tambah -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-zinc-100">
                    Kelola Lapangan Arena
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Daftar unit lapangan olahraga di
                    <span class="font-semibold text-zinc-200">
                        {{ $tenant?->display_name ?? 'Mitra Arena' }}
                    </span>
                </p>
            </div>

            <a href="{{ route('tenant.courts.manage.create') }}" class="...">+ Tambah Lapangan Baru</a>

        </div>


        <!-- Ringkasan Statistik -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <!-- Total Lapangan -->
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm">

                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">
                    Total Lapangan
                </span>

                <p class="mt-2 text-3xl font-extrabold text-zinc-100">
                    {{ $courts->count() }}
                </p>

            </div>


            <!-- Lapangan Aktif -->
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm">

                <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">
                    Status Aktif (Siap Sewa)
                </span>

                <p class="mt-2 text-3xl font-extrabold text-emerald-400">
                    {{ $courts->where('is_active', true)->count() }}
                </p>

            </div>


            <!-- Lapangan Non-Aktif -->
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm">

                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">
                    Non-Aktif / Maintenance
                </span>

                <p class="mt-2 text-3xl font-extrabold text-amber-400">
                    {{ $courts->where('is_active', false)->count() }}
                </p>

            </div>

        </div>


        <!-- Tabel Daftar Lapangan -->
        <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900 shadow-sm">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-xs text-zinc-300">

                    <!-- Table Header -->
                    <thead
                        class="border-b border-zinc-800 bg-zinc-950/60 font-semibold uppercase tracking-wider text-zinc-400">

                        <tr>
                            <th class="p-4">
                                Nama Lapangan
                            </th>

                            <th class="p-4">
                                Jenis Olahraga
                            </th>

                            <th class="p-4">
                                Permukaan Ground
                            </th>

                            <th class="p-4">
                                Status Operasional
                            </th>

                            <th class="p-4 text-right">
                                Aksi
                            </th>
                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody class="divide-y divide-zinc-800/60">

                        @forelse ($courts as $court)

                            <tr class="transition-colors hover:bg-zinc-800/40">

                                <!-- Nama Lapangan -->
                                <td class="flex items-center gap-3 p-4 font-bold text-zinc-100">

                                    <div class="rounded-xl border border-zinc-700/50 bg-zinc-800 p-2 text-emerald-400">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />

                                        </svg>

                                    </div>

                                    <span>
                                        {{ $court->name }}
                                    </span>

                                </td>


                                <!-- Jenis Olahraga -->
                                <td class="p-4">

                                    <span
                                        class="rounded-lg border border-zinc-700/50 bg-zinc-800 px-2.5 py-1 font-mono text-[11px] font-semibold uppercase text-zinc-300">
                                        {{ $court->type }}
                                    </span>

                                </td>


                                <!-- Jenis Permukaan -->
                                <td class="p-4 text-zinc-400">
                                    {{ $court->surface_type ?? 'Standar' }}
                                </td>


                                <!-- Status Operasional -->
                                <td class="p-4">

                                    @if ($court->is_active)

                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-[11px] font-semibold text-emerald-400">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Siap Sewa

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/20 bg-amber-500/10 px-2.5 py-1 text-[11px] font-semibold text-amber-400">

                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                            Non-Aktif

                                        </span>

                                    @endif

                                </td>


                                <!-- Tombol Aksi -->
                                <td class="p-4 text-right">

                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('tenant.courts.manage.edit', $court) }}"
                                            class="rounded-lg bg-zinc-800 p-2 text-zinc-300 hover:bg-zinc-700 hover:text-white transition-colors"
                                            title="Edit Data">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Form Hapus -->
                                        <form method="POST" action="{{ route('tenant.courts.manage.destroy', $court) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg bg-red-950/40 p-2 text-red-400 hover:bg-red-900/60 transition-colors"
                                                title="Hapus Lapangan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <!-- Kondisi Jika Belum Ada Lapangan -->
                            <tr>

                                <td colspan="5" class="p-8 text-center text-zinc-500">

                                    Belum ada lapangan yang terdaftar.

                                    Klik tombol
                                    <strong>+ Tambah Lapangan Baru</strong>
                                    di atas untuk menambah unit pertama.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection