
<!DOCTYPE html>
<html lang="id" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Portal Tenant Mitra') - Wangisport</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 font-sans antialiased">

    <div class="flex min-h-screen w-full bg-zinc-950">

        <!-- SIDEBAR -->
        <aside class="w-64 min-w-[16rem] min-h-screen flex flex-col justify-between sticky top-0 bg-zinc-900 border-r border-zinc-800">

            <div>

                <!-- LOGO -->
                <div class="p-6 flex items-center gap-3 border-b border-zinc-800">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white font-bold shadow-lg shadow-emerald-600/20">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'W', 0, 1)) }}
                    </div>

                    <div class="overflow-hidden">
                        <h2 class="text-sm font-bold text-white">
                            Wangisport
                        </h2>

                        <p class="text-[10px] font-semibold tracking-widest text-zinc-500">
                            PORTAL TENANT
                        </p>
                    </div>

                </div>

                <!-- NAVIGASI -->
                <div class="p-4 space-y-6">

                    <div>

                        <p class="px-3 mb-3 text-[10px] font-bold uppercase tracking-widest text-zinc-500">
                            Platform
                        </p>

                        <nav class="space-y-1">

                            <!-- DASHBOARD -->
                            <a href="{{ route('tenant.dashboard') }}"
                               class="flex items-center gap-3 rounded-xl px-3.5 py-3 text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>

                                Dashboard
                            </a>

                            <!-- KELOLA LAPANGAN -->
                            <a href="#"
                               class="flex items-center gap-3 rounded-xl px-3.5 py-3 text-xs font-medium text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all duration-200">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-6 0h6"/>
                                </svg>

                                Kelola Lapangan
                            </a>

                            <!-- JADWAL -->
                            <a href="#"
                               class="flex items-center gap-3 rounded-xl px-3.5 py-3 text-xs font-medium text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all duration-200">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>

                                Jadwal & Tarif
                            </a>

                            <!-- PEMESANAN -->
                            <a href="#"
                               class="flex items-center gap-3 rounded-xl px-3.5 py-3 text-xs font-medium text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all duration-200">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>

                                Pemesanan Masuk
                            </a>

                        </nav>

                    </div>

                </div>

            </div>

            <!-- PROFIL DAN LOGOUT -->
            <div class="p-4 border-t border-zinc-800 bg-zinc-900">

                <div class="flex items-center gap-3 px-2 py-3 mb-2">

                    <div class="w-9 h-9 shrink-0 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center text-sm font-bold text-emerald-400">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'O', 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-zinc-100 truncate">
                            {{ auth()->user()?->name ?? 'Operator Tenant' }}
                        </p>

                        <p class="text-[10px] text-zinc-500 truncate">
                            {{ auth()->user()?->email ?? 'tenant@wangisport.test' }}
                        </p>
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-xl transition-all duration-200">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>

                        Logout
                    </button>

                </form>

            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 min-w-0 min-h-screen bg-zinc-950 p-6 md:p-8 text-zinc-100">

            <!-- HEADER -->
            <div class="mb-6 border-b border-zinc-800 pb-5">

                <p class="text-[10px] font-bold tracking-[0.2em] text-emerald-500 uppercase mb-2">
                    WANGISPORT / TENANT MITRA
                </p>

                <h1 class="text-xl font-bold text-white">
                    @yield('page-heading', 'Dashboard Tenant')
                </h1>

                <p class="text-xs text-zinc-500 mt-1">
                    Kelola operasional dan aktivitas lapangan Anda.
                </p>

            </div>

            <!-- CONTENT DARI DASHBOARD -->
            @yield('content')

        </main>

    </div>

</body>
</html>
