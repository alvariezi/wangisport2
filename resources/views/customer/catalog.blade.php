<x-layouts.customer :title="'Sewa Lapangan - Wangisport'">

    {{-- Header / Hero Katalog --}}
    <section class="w-full py-14 px-6 sm:px-8 lg:px-16 bg-gradient-to-b from-[#072612] via-[#0B3B1C] to-[#0F172A] text-white">
        <div class="max-w-7xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 mb-6 text-xs sm:text-sm font-medium bg-slate-900 text-[#84CC16] rounded-full border border-slate-800 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#84CC16] animate-pulse"></span>
                Katalog Arena &amp; Lapangan Resmi Banyuwangi
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight uppercase">
                Sewa Lapangan Olahraga <br class="hidden sm:block"> <span class="bg-gradient-to-r from-[#A3E635] via-[#84CC16] to-[#10B981] bg-clip-text text-transparent">Kabupaten Banyuwangi</span> 
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto">
                Cari arena favoritmu, cek slot jadwal jam bermain secara live, dan reservasi instan tanpa ribet antre.
            </p>
        </div>
    </section>

    {{-- Filter & Pencarian --}}
    <section class="w-full px-6 sm:px-8 lg:px-16 pt-2 pb-6 bg-gradient-to-b from-[#0F172A] via-[#0F172A] to-[#F8FAFC] relative z-10">
        <form method="GET" action="{{ url()->current() }}" class="max-w-7xl mx-auto bg-white text-slate-900 rounded-2xl shadow-xl border border-slate-200 p-4 sm:p-5 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-6">
                    <input type="text"
                        name="q"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama lapangan, arena, atau venue..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-[#84CC16]">
                </div>

                <div class="md:col-span-4">
                    <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:border-[#84CC16]">
                        <option value="all" {{ ($category ?? 'all') === 'all' ? 'selected' : '' }}>Semua Olahraga</option>
                        <option value="futsal" {{ ($category ?? '') === 'futsal' ? 'selected' : '' }}>Futsal</option>
                        <option value="badminton" {{ ($category ?? '') === 'badminton' ? 'selected' : '' }}>Badminton</option>
                        <option value="mini-soccer" {{ ($category ?? '') === 'mini-soccer' ? 'selected' : '' }}>Mini Soccer</option>
                        <option value="padel" {{ ($category ?? '') === 'padel' ? 'selected' : '' }}>Padel</option>
                        <option value="basket" {{ ($category ?? '') === 'basket' ? 'selected' : '' }}>Basket</option>
                        <option value="tenis" {{ ($category ?? '') === 'tenis' ? 'selected' : '' }}>Tenis</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#84CC16] hover:bg-[#65A30D] text-slate-950 font-bold text-sm transition cursor-pointer">
                        Cari Arena
                    </button>
                </div>
            </div>

            {{-- Filter Cepat Kategori --}}
            @php
            $quickCategories = [
            'all' => 'Semua',
            'badminton' => 'Badminton',
            'futsal' => 'Futsal',
            'mini-soccer' => 'Mini Soccer',
            'basket' => 'Basket',
            'padel' => 'Padel',
            ];
            $activeCat = $category ?? 'all';
            @endphp
            <div class="flex flex-wrap items-center gap-2 pt-1 text-xs">
                <span class="text-slate-500 font-medium mr-1">Pilihan Cepat:</span>
                @foreach($quickCategories as $slug => $label)
                <a href="{{ url()->current() . ($slug !== 'all' ? '?category=' . $slug : '') }}"
                    class="px-3 py-1.5 rounded-full font-semibold transition {{ $activeCat === $slug ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </form>
    </section>

    {{-- Daftar Lapangan Olahraga dari Database --}}
    <section class="w-full py-12 lg:py-16 px-6 sm:px-8 lg:px-16 bg-[#F8FAFC] text-slate-900">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Daftar Lapangan Olahraga</h2>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#84CC16]/20 text-[#4D7C0F]">
                            {{ $courts->total() }} Lapangan Ditemukan
                        </span>
                    </div>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">
                        Pilih arena olahraga standar turnamen &amp; rekreasi terfavorit di Banyuwangi.
                    </p>
                </div>
            </div>

            @if($courts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courts as $court)
                <a href="{{ route('customer.courts.show', $court->id) }}" aria-label="Lihat detail {{ $court->court_name }}" class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-lime-500 transition flex flex-col justify-between">
                    <div>
                        {{-- Thumbnail & Badge --}}
                        <div class="relative h-48 bg-slate-900 overflow-hidden">
                            <img src="{{ $court->gambar ? asset('storage/' . $court->gambar) : asset('rectangle-6.png') }}"
                                alt="{{ $court->court_name }}"
                                class="w-full h-full object-cover object-center">

                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-[#84CC16] text-slate-950">
                                {{ $court->type }}
                            </span>

                            <span class="absolute bottom-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-medium bg-slate-950/75 text-white backdrop-blur-sm">
                                {{ $court->venue_name }}
                            </span>
                        </div>

                        {{-- Detail Lapangan --}}
                        <div class="p-5 space-y-3">
                            <div>
                                <h3 class="font-extrabold text-base sm:text-lg text-slate-900 uppercase tracking-tight">
                                    {{ $court->court_name }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $court->tenant_name }}
                                </p>
                            </div>

                            {{-- Tag Tipe & Permukaan Lapangan --}}
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-[11px] font-medium uppercase">
                                    {{ $court->type }}
                                </span>
                                @if($court->surface_type)
                                <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-[11px] font-medium">
                                    {{ $court->surface_type }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Harga & Tombol Aksi --}}
                    <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-between gap-3">
                        <div>
                            @if(!is_null($court->starting_price))
                            <p class="text-[11px] text-slate-400">Mulai dari</p>
                            <p class="text-base sm:text-lg font-extrabold text-slate-900">
                                Rp {{ number_format($court->starting_price, 0, ',', '.') }}
                            </p>
                            @else
                            <p class="text-xs font-semibold text-slate-500">Hubungi Venue</p>
                            @endif
                        </div>

                        <span class="px-4 py-2 rounded-xl bg-slate-900 group-hover:bg-[#84CC16] text-white text-xs font-bold transition inline-flex items-center gap-1.5">
                            <span>Pilih Jadwal</span>
                            <span>&rarr;</span>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $courts->links() }}
            </div>
            @else
            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center space-y-2">
                <p class="font-bold text-slate-800 text-base">Belum ada lapangan yang sesuai filter.</p>
                <p class="text-slate-500 text-sm">Coba pilih kategori lain atau reset kata kunci pencarian.</p>
            </div>
            @endif

        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-[#070B12] border-t border-slate-800/80 pt-14 pb-8 px-6 sm:px-8 lg:px-16 text-slate-400 text-xs sm:text-sm w-full">
        <div class="w-full">
            <!-- Grid 4 Kolom Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12">

                <!-- Kolom 1: Brand & Badge Status (5 kolom di desktop) -->
                <div class="lg:col-span-5 space-y-4">
                    <a href="#" class="inline-block text-xl font-black tracking-wider text-white">
                        WANGI<span class="text-[#A3E635]">SPORT</span>
                    </a>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-sm">
                        Main kapan saja, booking di mana saja. Platform direktori &amp; reservasi arena olahraga paling simpel dan tepercaya.
                    </p>
                    <div class="pt-1">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-slate-800 text-xs font-semibold text-[#84CC16]">
                            <span class="w-2 h-2 rounded-full bg-[#84CC16] animate-pulse"></span>
                            Sistem Aktif 24/7
                        </span>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi (2 kolom di desktop) -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold tracking-wider text-slate-300 uppercase">Navigasi</h3>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-white transition">Sewa Lapangan</a></li>
                        <li><a href="#lapangan" class="hover:text-white transition">Pesanan Saya</a></li>
                        <li><a href="#lapangan" class="hover:text-white transition">Kontak Kami</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan (2 kolom di desktop) -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold tracking-wider text-slate-300 uppercase">Layanan</h3>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="#lapangan" class="hover:text-white transition">Sewa Lapangan</a></li>
                        <li><a href="#lapangan" class="hover:text-white transition">Cek Jadwal</a></li>
                        <li><a href="#" class="hover:text-white transition">Gabung Mitra Venue</a></li>
                        <li><a href="#" class="hover:text-white transition">Bantuan Booking</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak (3 kolom di desktop) -->
                <div class="lg:col-span-3 space-y-4">
                    <h3 class="text-xs font-bold tracking-wider text-slate-300 uppercase">Kontak</h3>
                    <ul class="space-y-3 text-xs sm:text-sm text-slate-400">
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#84CC16] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>08123456789</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#84CC16] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="break-all">wangisport77@gmail.com</span>
                        </li>
                        <li class="text-xs text-slate-500 leading-relaxed pt-1">
                            Banyuwangi &amp; Sekitarnya, Jawa Timur, Indonesia.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</x-layouts.customer>