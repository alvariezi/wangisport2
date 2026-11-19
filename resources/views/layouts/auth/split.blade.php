<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark antialiased">
<head>
    @include('partials.head', ['title' => $title ?? 'Masuk ke Wangisport'])
</head>
<body class="min-h-screen bg-[#080e0b] text-white">
    <div class="grid min-h-screen lg:grid-cols-[1.05fr_0.95fr]">
        {{-- BRAND PANEL --}}
        <aside class="relative hidden overflow-hidden border-r border-white/10 bg-[#092817] lg:flex lg:min-h-screen lg:flex-col lg:justify-between lg:p-12 xl:p-16">
            <div class="pointer-events-none absolute -right-48 -top-44 h-[550px] w-[550px] rounded-full bg-lime-400/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-48 -left-44 h-[550px] w-[550px] rounded-full bg-emerald-500/15 blur-3xl"></div>
            {{-- Subtle decorative sports-field lines --}}
            <div class="pointer-events-none absolute inset-0 opacity-[0.09]" style="background-image:linear-gradient(rgba(255,255,255,.4) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.4) 1px,transparent 1px);background-size:80px 80px;"></div>
            <div class="relative z-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-lime-400 text-2xl font-black text-[#092817] shadow-lg shadow-lime-400/20">W</span>
                    <span class="text-2xl font-black tracking-tight">WANGI<span class="text-lime-400">SPORT</span></span>
                </a>
            </div>
            <div class="relative z-10 max-w-xl space-y-7">
                <div class="inline-flex items-center gap-2 rounded-full border border-lime-400/25 bg-lime-400/10 px-4 py-2 text-xs font-bold tracking-wide text-lime-300">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-lime-400"></span>
                    PLATFORM RESERVASI OLAHRAGA
                </div>
                <h1 class="text-5xl font-black leading-[1.1] tracking-tight xl:text-6xl">Kelola arena.<br><span class="text-lime-400">Main lebih mudah.</span></h1>
                <p class="max-w-md text-base leading-8 text-white/65">Satu pintu untuk pengelolaan venue, lapangan, dan reservasi olahraga. Akses dashboard sesuai akun Anda.</p>
                <div class="grid max-w-md grid-cols-2 gap-4 pt-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
                        <svg class="mb-3 h-7 w-7 text-lime-400" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21V6a2 2 0 012-2h14a2 2 0 012 2v15M3 21h18M8 9h2m4 0h2m-8 4h2m4 0h2m-7 8v-4h6v4"/></svg>
                        <p class="text-sm font-bold">Manajemen Venue</p><p class="mt-1 text-xs text-white/50">Seluruh arena lebih tertata</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
                        <svg class="mb-3 h-7 w-7 text-lime-400" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 3v4m10-4v4M3 10h18m-13 5h3"/></svg>
                        <p class="text-sm font-bold">Kelola Jadwal</p><p class="mt-1 text-xs text-white/50">Lapangan siap dipesan</p>
                    </div>
                </div>
            </div>
            <p class="relative z-10 text-xs text-white/40">© {{ date('Y') }} Wangisport · Banyuwangi, Jawa Timur</p>
        </aside>

        {{-- LOGIN PANEL --}}
        <main class="relative flex min-h-screen flex-col items-center justify-center px-5 py-12 sm:px-10 lg:px-16">
            <div class="absolute right-5 top-5 sm:right-10 sm:top-9">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2 text-xs font-semibold text-zinc-300 transition hover:border-lime-400/40 hover:text-lime-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke beranda
                </a>
            </div>
            <div class="mb-10 mt-12 flex items-center gap-3 lg:hidden">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-lime-400 text-xl font-black text-[#092817]">W</span>
                <span class="text-xl font-black">WANGI<span class="text-lime-400">SPORT</span></span>
            </div>
            <div class="w-full max-w-[440px]">
                {{ $slot }}
            </div>
            <p class="mt-12 text-center text-xs text-zinc-600">Akun Super Admin dan Operator Venue menggunakan halaman login yang sama.</p>
        </main>
    </div>
    @persist('toast')
        <flux:toast.group />
    @endpersist
    @fluxScripts
</body>
</html>
