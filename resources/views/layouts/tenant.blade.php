@props([
    'title' => 'Portal Tenant Mitra',
])

<!DOCTYPE html>
<html lang="id" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }} - Portal Tenant</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>

<body class="h-full bg-zinc-950 font-sans text-zinc-100 antialiased">

    <div class="flex min-h-screen">

        {{-- Sidebar Navigation --}}
        <aside class="flex min-h-screen w-64 shrink-0 flex-col justify-between border-r border-zinc-800 bg-zinc-900">

            <div>

                {{-- Brand Logo --}}
                <div class="flex items-center gap-3 border-b border-zinc-800 p-6">

                    <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-2 text-emerald-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-extrabold tracking-wide text-zinc-100">
                            PORTAL TENANT
                        </h2>

                        <p class="text-[11px] font-medium text-emerald-400">
                            Mitra Arena Olahraga
                        </p>
                    </div>

                </div>

                {{-- Menu Sidebar --}}
                <nav class="space-y-1 p-4">

                    {{-- Dashboard --}}
                    <a href="{{ route('tenant.dashboard') }}" class="{{ request()->routeIs('tenant.dashboard')
    ? 'border border-emerald-500/20 bg-emerald-600/10 font-semibold text-emerald-400'
    : 'text-zinc-400 hover:bg-zinc-800/70 hover:text-zinc-200' }}
                            flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-xs font-medium transition-colors">
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>

                        Dashboard Tenant
                    </a>

                    {{-- Kelola Lapangan --}}
                    <a href="{{ route('tenant.courts.manage') }}" class="{{ request()->routeIs('tenant.courts.*')
    ? 'border border-emerald-500/20 bg-emerald-600/10 font-semibold text-emerald-400'
    : 'text-zinc-400 hover:bg-zinc-800/70 hover:text-zinc-200' }}
                            flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-xs font-medium transition-colors">
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>

                        Kelola Lapangan
                    </a>

                </nav>

            </div>

            {{-- Profile & Logout --}}
            <div class="border-t border-zinc-800 p-4">

                <div class="mb-2 px-3 py-2">

                    <p class="truncate text-xs font-bold text-zinc-200">
                        {{ auth()->user()?->name ?? 'Operator Tenant' }}
                    </p>

                    <p class="truncate text-[10px] font-medium text-emerald-400">
                        {{ auth()->user()?->email }}
                    </p>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full rounded-xl px-3 py-2 text-left text-xs font-semibold text-red-400 transition-colors hover:bg-red-950/30">
                        <span class="inline-flex items-center gap-2">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>

                            Keluar (Logout)

                        </span>
                    </button>

                </form>

            </div>

        </aside>

        {{-- Main Content Area --}}
        <main class="min-h-screen flex-1 overflow-y-auto bg-zinc-950 p-6 md:p-8"> @yield('content') </main>

    </div>

</body>

</html>