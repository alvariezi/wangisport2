
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Portal Tenant - Wangisport')</title>

    @include('partials.head')
</head>

<body class="min-h-screen bg-[#090909] font-sans text-white antialiased">

    <div class="flex min-h-screen">

        {{-- ========================================= --}}
        {{-- SIDEBAR TENANT --}}
        {{-- ========================================= --}}

        <aside
            class="sticky top-0 flex h-screen w-64 shrink-0 flex-col
                   border-r border-zinc-800 bg-[#171717]">

            {{-- BAGIAN ATAS SIDEBAR --}}
            <div class="flex min-h-0 flex-1 flex-col">

                {{-- LOGO / IDENTITAS --}}
                <div class="shrink-0 border-b border-zinc-800 px-5 py-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center
                                   justify-center rounded-xl
                                   border border-emerald-500/20
                                   bg-emerald-500/10 text-emerald-400">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m4-4h2m-2 4h2M9 21v-5h6v5"/>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <h2
                                class="text-sm font-black uppercase
                                       tracking-wide text-white">
                                Portal Tenant
                            </h2>

                            <p
                                class="mt-1 text-[10px] font-semibold
                                       text-emerald-400">
                                Mitra Arena Olahraga
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ========================================= --}}
                {{-- AREA NAVIGASI DENGAN SCROLL --}}
                {{-- ========================================= --}}

                <div
                    class="min-h-0 flex-1 overflow-y-auto
                           px-4 py-5">

                    <nav class="space-y-1">

                        {{-- DASHBOARD --}}
                        <a
                            href="{{ route('tenant.dashboard') }}"
                            class="flex items-center gap-3 rounded-xl
                                   px-4 py-3 text-xs font-semibold
                                   transition-all duration-200

                            {{ request()->routeIs('tenant.dashboard')
                                ? 'border border-emerald-500/20 bg-emerald-500/10 text-emerald-400'
                                : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">

                            <svg
                                class="h-4 w-4 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>

                            </svg>

                            <span>Dashboard Tenant</span>

                        </a>


                        {{-- KELOLA LAPANGAN --}}
                        <a
                            href="{{ route('tenant.courts.manage') }}"
                            class="flex items-center gap-3 rounded-xl
                                   px-4 py-3 text-xs font-semibold
                                   transition-all duration-200

                            {{ request()->routeIs('tenant.courts.manage*')
                                ? 'border border-emerald-500/20 bg-emerald-500/10 text-emerald-400'
                                : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">

                            <svg
                                class="h-4 w-4 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1"/>

                            </svg>

                            <span>Kelola Lapangan</span>

                        </a>


                        {{-- TAMBAH LAPANGAN --}}
                        <a
                            href="{{ route('tenant.courts.manage.create') }}"
                            class="flex items-center gap-3 rounded-xl
                                   px-4 py-3 text-xs font-semibold
                                   text-zinc-400 transition-all
                                   duration-200 hover:bg-zinc-800
                                   hover:text-white">

                            <svg
                                class="h-4 w-4 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"/>

                            </svg>

                            <span>Tambah Lapangan</span>

                        </a>


                        {{-- ========================================= --}}
                        {{-- SIDEBAR DAFTAR COURTS --}}
                        {{-- ========================================= --}}

                        @include('partials.sidebar-courts')

                    </nav>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- PROFIL OPERATOR & LOGOUT --}}
            {{-- ========================================= --}}

            <div
                class="shrink-0 border-t border-zinc-800
                       bg-[#171717] p-4">

                {{-- INFORMASI OPERATOR --}}
                <div class="mb-4 flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center
                               justify-center rounded-full
                               bg-emerald-500/10 text-sm
                               font-black text-emerald-400">

                        {{ strtoupper(substr(auth()->user()?->name ?? 'OP', 0, 2)) }}

                    </div>

                    <div class="min-w-0 flex-1">

                        <p
                            class="truncate text-xs font-bold
                                   text-white">

                            {{ auth()->user()?->name ?? 'Operator Tenant' }}

                        </p>

                        <p
                            class="mt-1 truncate text-[10px]
                                   text-emerald-400">

                            {{ auth()->user()?->email ?? '-' }}

                        </p>

                    </div>

                </div>


                {{-- LOGOUT --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    data-logout-confirm>

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3
                               rounded-xl px-3 py-3
                               text-xs font-bold text-red-400
                               transition-all duration-200
                               hover:bg-red-500/10">

                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>

                        </svg>

                        <span>Keluar (Logout)</span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- ========================================= --}}
        {{-- KONTEN UTAMA TENANT --}}
        {{-- ========================================= --}}

        <div class="flex min-w-0 flex-1 flex-col">

            <main class="min-w-0 flex-1 px-6 py-8 lg:px-8">

                @yield('content')

            </main>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- POPUP LOGOUT --}}
    {{-- ========================================= --}}

    @fluxScripts

    @include('partials.logout-modal')

</body>
</html>
