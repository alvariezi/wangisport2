
@extends('layouts.tenant')

@section('title', 'Dashboard Tenant Mitra')

@section('page-heading', 'Dashboard Tenant')

@section('content')

<div class="space-y-6">

    <!-- HEADER TENANT -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex flex-wrap items-center gap-3">

                <h2 class="text-2xl font-bold text-zinc-100">
                    {{ $tenant?->display_name ?? 'Siliwangi Arena Futsal & Badminton' }}
                </h2>
            </div>

            <p class="text-sm text-zinc-400 mt-2">
                Lokasi Induk:

                <span class="font-medium text-zinc-200">
                    {{ $tenant?->venue?->name ?? 'GOR Siliwangi Sports Center' }}
                </span>
            </p>
        </div>

        
    </div>


    <!-- METRIC CARDS -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <!-- CARD 1: TOTAL LAPANGAN -->
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">
                        Total Lapangan
                    </span>

                    <h2 class="text-3xl font-extrabold text-zinc-100 mt-2">
                        {{ $totalCourts ?? 0 }}
                    </h2>

                    <p class="text-xs text-zinc-500 mt-1">
                        Unit arena terdaftar
                    </p>

                </div>

                <div class="rounded-2xl bg-zinc-800 p-3.5 text-zinc-300 border border-zinc-700/50">

                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-6 0h6"/>
                    </svg>

                </div>

            </div>

        </div>


        <!-- CARD 2: LAPANGAN AKTIF -->
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">
                        Lapangan Aktif
                    </span>

                    <h2 class="text-3xl font-extrabold text-emerald-400 mt-2">
                        {{ $activeCourts ?? 0 }}
                    </h2>

                    <p class="text-xs text-zinc-500 mt-1">
                        Siap menerima pemesanan
                    </p>

                </div>

                <div class="rounded-2xl bg-emerald-500/10 p-3.5 text-emerald-400 border border-emerald-500/20">

                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                </div>

            </div>

        </div>


        <!-- CARD 3: KOMISI PLATFORM -->
        <div class="rounded-2xl border border-indigo-500/20 bg-indigo-950/20 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-400">
                        Potongan Komisi Platform
                    </span>

                    <h2 class="text-3xl font-extrabold text-indigo-400 mt-2">

                        {{ $tenant?->activeCommissionScheme
                            ? number_format($tenant->activeCommissionScheme->commission_rate, 2) . '%'
                            : '15.00%' }}

                    </h2>

                    <p class="text-xs text-zinc-400 mt-1">

                        {{ $tenant?->activeCommissionScheme
                            ? 'Tarif Komisi Khusus Tenant'
                            : 'Tarif Komisi Default Platform' }}

                    </p>

                </div>

                <div class="rounded-2xl bg-indigo-600/10 p-3.5 text-indigo-400 border border-indigo-500/20">

                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- AKSES CEPAT PENGELOLAAN -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <div class="lg:col-span-3 rounded-2xl border border-zinc-800 bg-zinc-900 p-6 shadow-sm">

            <h3 class="font-bold text-zinc-100 mb-5 text-sm uppercase tracking-wider">
                Akses Cepat Pengelolaan
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">


                <!-- MENU DAFTAR LAPANGAN -->
                <a href="#"
                   class="group flex items-center justify-between p-4 rounded-xl border border-zinc-800 bg-zinc-950/50 hover:bg-zinc-800/50 hover:border-emerald-500/30 transition-all">

                    <div class="flex items-center gap-3">

                        <div class="rounded-lg bg-emerald-500/10 p-2.5 text-emerald-400 border border-emerald-500/20">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>

                        </div>

                        <div>

                            <h4 class="text-xs font-bold text-zinc-200 group-hover:text-emerald-400 transition-colors">
                                Daftar Lapangan
                            </h4>

                            <p class="text-[11px] text-zinc-500 mt-1">
                                Atur unit arena & fasilitas
                            </p>

                        </div>

                    </div>

                    <svg class="w-4 h-4 text-zinc-600 group-hover:text-zinc-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"/>
                    </svg>

                </a>


                <!-- MENU JADWAL -->
                <a href="#"
                   class="group flex items-center justify-between p-4 rounded-xl border border-zinc-800 bg-zinc-950/50 hover:bg-zinc-800/50 hover:border-blue-500/30 transition-all">

                    <div class="flex items-center gap-3">

                        <div class="rounded-lg bg-blue-500/10 p-2.5 text-blue-400 border border-blue-500/20">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                        </div>

                        <div>

                            <h4 class="text-xs font-bold text-zinc-200 group-hover:text-blue-400 transition-colors">
                                Pengaturan Jadwal
                            </h4>

                            <p class="text-[11px] text-zinc-500 mt-1">
                                Kelola timeslot & tarif harga
                            </p>

                        </div>

                    </div>

                    <svg class="w-4 h-4 text-zinc-600 group-hover:text-zinc-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"/>
                    </svg>

                </a>


                <!-- MENU PEMESANAN -->
                <a href="#"
                   class="group flex items-center justify-between p-4 rounded-xl border border-zinc-800 bg-zinc-950/50 hover:bg-zinc-800/50 hover:border-indigo-500/30 transition-all">

                    <div class="flex items-center gap-3">

                        <div class="rounded-lg bg-indigo-500/10 p-2.5 text-indigo-400 border border-indigo-500/20">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>

                        </div>

                        <div>

                            <h4 class="text-xs font-bold text-zinc-200 group-hover:text-indigo-400 transition-colors">
                                Pemesanan Masuk
                            </h4>

                            <p class="text-[11px] text-zinc-500 mt-1">
                                Verifikasi booking & pembayaran
                            </p>

                        </div>

                    </div>

                    <svg class="w-4 h-4 text-zinc-600 group-hover:text-zinc-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"/>
                    </svg>

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
