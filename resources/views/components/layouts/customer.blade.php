<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Wangisport - Sewa Lapangan Olahraga' }}</title>

    <!-- Memanggil CSS & JS Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0B0F17]/78 text-white font-sans antialiased selection:bg-[#A3E635] selection:text-slate-950 min-h-screen flex flex-col m-0 p-0 overflow-x-hidden w-full">

    <!-- Navbar / Header -->
    <header class="sticky top-0 z-50 bg-[#0F172A]/90 backdrop-blur-md border-b border-slate-800 w-full">
        <div class="w-full px-6 sm:px-8 lg:px-16 h-20 flex items-center justify-between">

            <!-- 1. Bagian Kiri: Logo (Diberi flex-1 agar mengambil porsi ruang yang sama) -->
            <div class="flex-1 flex items-center justify-start">
                <span class="text-xl font-black tracking-wider text-white">WANGI<span class="text-[#A3E635]">SPORT</span></span>
            </div>

            <!-- 2. Bagian Tengah: Menu Navigasi (Dibuat center absolut) -->
            <nav class="hidden md:flex items-center justify-center gap-8 text-sm font-medium text-slate-300 flex-1">
                <a href="#" class="px-1 py-2.5 font-bold rounded-xl hover:bg-[#84CC16] hover:text-[#020617] transition">Beranda</a>
                <a href="#tentang" class="px-1 py-2.5 font-bold rounded-xl hover:bg-[#84CC16] hover:text-[#020617] transition">Sewa Lapangan</a>
                <a href="#lapangan" class="px-1 py-2.5 font-bold rounded-xl hover:bg-[#84CC16] hover:text-[#020617] transition">Pesanan Saya</a>
                <a href="#lapangan" class="px-1 py-2.5 font-bold rounded-xl hover:bg-[#84CC16] hover:text-[#020617] transition">Kontak Kami</a>
            </nav>

            <!-- 3. Bagian Kanan -->
            <div class="flex-1 flex items-center justify-end gap-3">
                <a href="#lapangan" class="px-5 py-2.5 bg-[#84CC16] text-slate-950 font-bold text-xs sm:text-sm rounded-xl hover:bg-[#0F172A] hover:text-[#CBD5E1] border border-transparent hover:border-[#CBD5E1] transition">
                    Booking Sekarang
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