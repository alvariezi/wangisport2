<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Wangisport - Sewa Lapangan Olahraga' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#0B0F17]/78 text-white font-sans antialiased selection:bg-[#A3E635] selection:text-slate-950 min-h-screen flex flex-col m-0 p-0 overflow-x-hidden w-full">

    <!-- Navbar / Header -->
    <header class="sticky top-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800/80 w-full">
        <div class="w-full px-6 sm:px-8 lg:px-16 h-20 flex items-center justify-between gap-4">
            <div class="flex-1 flex items-center justify-start">
                <a href="{{ route('home') }}" class="text-xl font-black tracking-wider text-white">
                    WANGI<span class="text-[#84CC16]">SPORT</span>
                </a>
            </div>

            <nav class="hidden md:flex items-center justify-center p-1.5 rounded-full bg-slate-900/90 border border-slate-800/90 text-xs lg:text-sm font-semibold text-slate-300 shadow-inner">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 rounded-full transition {{ request()->routeIs('home') ? 'bg-[#84CC16] text-slate-950 font-bold shadow-[0_0_20px_rgba(132,204,22,0.35)]' : 'hover:text-white' }}">
                    Beranda
                </a>

                <a href="{{ route('customer.catalog') }}"
                    class="px-4 py-2 rounded-full transition {{ request()->routeIs('customer.catalog') ? 'bg-[#84CC16] text-slate-950 font-bold shadow-[0_0_20px_rgba(132,204,22,0.35)]' : 'hover:text-white' }}">
                    Sewa Lapangan
                </a>

                <a href="#lapangan"
                    class="px-4 py-2 rounded-full hover:text-white transition">
                    Pesanan Saya
                </a>

                <a href="#lapangan"
                    class="px-4 py-2 rounded-full hover:text-white transition">
                    Kontak Kami
                </a>
            </nav>

            <!-- 3. Bagian Kanan: Tombol CTA -->
            <div class="flex-1 flex items-center justify-end gap-3">
                <a href="{{ route('customer.catalog') }}"
                    class="px-5 py-2.5 bg-[#84CC16] hover:bg-[#A3E635] text-slate-950 font-extrabold text-xs sm:text-sm rounded-full transition shadow-[0_0_24px_rgba(132,204,22,0.3)]">
                    Booking Sekarang &rarr;
                </a>
            </div>

        </div>
    </header>

    <!-- Konten Utama -->
    <main class="w-full flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#0B0F17] border-t border-slate-800/80 py-8 px-6 sm:px-8 lg:px-16 text-slate-500 text-xs sm:text-sm w-full">
        <div class="w-full flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} Wangisport Multi-Tenant System. Seluruh hak cipta dilindungi.</p>
            <div class="flex gap-6 text-slate-400">
                <a href="#" class="hover:text-[#A3E635] transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-[#A3E635] transition">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>

</html>