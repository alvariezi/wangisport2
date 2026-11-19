
@props(['title' => 'Admin Platform'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
    @include('partials.head', ['title' => $title])
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR KIRI -->
        <aside class="sticky top-0 flex h-screen w-64 shrink-0 flex-col justify-between border-r border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900">

            <div class="space-y-6">

                <!-- LOGO -->
                <div class="flex items-center gap-3 px-2 pt-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-base font-black text-white shadow-md shadow-indigo-600/30">
                        W
                    </span>

                    <div>
                        <div class="text-sm font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100">
                            Wangisport
                        </div>
                        <div class="text-[10px] font-semibold uppercase tracking-wider text-zinc-500">
                            Super Admin
                        </div>
                    </div>
                </div>

                <!-- NAVIGASI -->
                <nav class="space-y-1">

                    <div class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-zinc-400">
                        Platform
                    </div>

                    <!-- DASHBOARD -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-semibold transition-colors
                        {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-950/80 dark:text-indigo-400' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60' }}">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>

                        Dashboard
                    </a>

                    <!-- DAFTAR VENUE -->
                    <a href="{{ route('admin.venues.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition-colors
                        {{ request()->routeIs('admin.venues.*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-950/50 dark:text-indigo-400' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60' }}">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>

                        Daftar Venue
                    </a>

                    <!-- MANAJEMEN OPERATOR -->
                    <a href="{{ route('admin.operators.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition-colors
                        {{ request()->routeIs('admin.operators.*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-950/50 dark:text-indigo-400' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60' }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm8 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                        Manajemen Operator
                    </a>

                    <!-- PINTASAN VENUE -->
                    <div class="mb-2 px-3 pt-4 text-[10px] font-bold uppercase tracking-wider text-zinc-400">
                        Akses Cepat
                    </div>

                    <a href="{{ route('admin.venues.create') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition-colors {{ request()->routeIs('admin.venues.create') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-950/50 dark:text-indigo-400' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60' }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Venue
                    </a>

                    <a href="{{ route('admin.dashboard') }}#grafik-venue"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition-colors text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19V5m0 14h16M8 16v-4m5 4V8m5 8V6" />
                        </svg>
                        Statistik Venue
                    </a>

                </nav>
            </div>

            <!-- PROFIL DAN LOGOUT -->
            <div class="border-t border-zinc-200/80 pt-3 dark:border-zinc-800">

                <!-- INFORMASI PENGGUNA -->
                <div class="flex items-center gap-3 px-2 py-2">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'SA', 0, 2)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="truncate text-xs font-bold text-zinc-900 dark:text-zinc-100">
                            {{ auth()->user()?->name ?? 'Super Admin' }}
                        </div>

                        <div class="truncate text-[10px] text-zinc-500">
                            {{ auth()->user()?->email ?? 'admin@wangisport.test' }}
                        </div>
                    </div>

                </div>

                <!-- TOMBOL LOGOUT -->
                <form method="POST" action="{{ route('logout') }}" data-logout-confirm class="mt-2">
                    @csrf

                    <button
                        type="submit"
                        
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-semibold text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/40">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>

                        <span>Logout</span>
                    </button>
                </form>

            </div>

        </aside>

        <!-- KONTEN UTAMA -->
        <div class="flex min-w-0 flex-1 flex-col">

            <!-- HEADER -->
            <header class="sticky top-0 z-10 border-b border-zinc-200/80 bg-white/80 px-6 py-3.5 backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/80">

                <div class="flex items-center justify-between">

                    <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        {{ $title }}
                    </h2>
                </div>

            </header>

            <!-- SLOT KONTEN -->
            <main class="flex-1 p-6 sm:p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

    @fluxScripts

    @include('partials.logout-modal')
</body>
</html>
