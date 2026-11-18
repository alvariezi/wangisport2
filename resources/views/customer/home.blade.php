<x-layouts.customer :title="'Beranda - ' . ($canteen ?? 'Venue Olahraga')">
    <div class="min-h-screen bg-[#0B0F17]/78 text-white font-sans overflow-x-hidden selection:bg-[#84CC16] selection:text-slate-950 w-full">

        {{-- Hero Section --}}
        <section class="w-full relative overflow-hidden py-16 lg:py-28 px-6 sm:px-8 lg:px-16 border-b border-slate-800/80 bg-">
            <div class="w-full flex flex-col items-center text-center">
                {{-- Badge Info --}}
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 mb-6 text-xs sm:text-sm font-medium bg-slate-900 text-[#84CC16] rounded-full border border-slate-800 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#84CC16] animate-pulse"></span>
                    Booking Instan & Terverifikasi 
                </span>

                {{-- Judul Utama --}}
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-[1.1]">
                    Cari & Sewa Lapangan Olahraga <span class="text-[#84CC16] block sm:inline">Tanpa Ribet</span>
                </h1>

                {{-- Deskripsi --}}
                <p class="text-slate-400 text-base sm:text-lg lg:text-xl mb-8 leading-relaxed max-w-3xl mx-auto">
                    Cek ketersediaan jadwal secara langsung, bayar online, dan siap main bersama timmu. Praktis tanpa perlu repot konfirmasi manual!
                </p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center w-full sm:w-auto">
                    <a href="#lapangan" class="px-8 py-4 bg-[#84CC16] text-slate-950 font-bold text-xs sm:text-sm rounded-xl hover:bg-[#0F172A] hover:text-[#CBD5E1] border border-transparent hover:border-[#CBD5E1] transition">
                        Pesan Lapangan &rarr;
                    </a>
                    <a href="#tentang" class="px-8 py-4 bg-slate-900 text-white font-medium rounded-xl hover:bg-slate-800 transition border border-slate-800 text-center">
                        Baca Selengkapnya
                    </a>
                </div>

            </div>
        </section>

        {{-- Tentang Kami Section --}}
        <section id="tentang" class="w-full py-16 lg:py-24 px-6 sm:px-8 lg:px-16 bg-[#F8FAFC] border-b border-slate-800/80">
            <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div>
                    <span class="inline-block px-3 py-1 mb-3 text-xs font-semibold bg-[#84CC16]/10 text-[#65A30D] border border-[#84CC16]/20 rounded-full tracking-wider uppercase">Tentang Kami</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6 leading-snug text-[#0F172A]">
                        Sewa lapangan dengan <span class="text-[#65A30D] block sm:inline underline underline-offset-4 decoration-2 text-[#65A30D]">mudah dan cepat.</span>
                    </h2>
                    <p class="text-[#475569] text-base sm:text-lg mb-8 leading-relaxed">
                        Cek ketersediaan jadwal dan amankan lapangan favoritmu secara langsung online. Praktis, tanpa perlu repot datang atau ragu kehabisan slot bersama rekan seperjuanganmu.
                    </p>
                    <ul class="space-y-4 text-[#475569] text-sm sm:text-base font-medium">
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-[#84CC16]/10 text-[#65A30D] flex items-center justify-center text-xs font-bold border border-[#84CC16]/30">✓</span>
                            <span>Jadwal Kalender Real-time & Konfirmasi Otomatis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-[#84CC16]/10 text-[#65A30D] flex items-center justify-center text-xs font-bold border border-[#84CC16]/30">✓</span>
                            <span>Metode Pembayaran Lengkap (QRIS, VA, E-Wallet)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-[#84CC16]/10 text-[#65A30D] flex items-center justify-center text-xs font-bold border border-[#84CC16]/30">✓</span>
                            <span>Standar Venue Bersih & Fasilitas Berstandar Turnamen</span>
                        </li>
                    </ul>
                </div>

                {{-- Grid 4 Fasilitas / Foto Venue --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Card 1: Court Tenis Outdoor -->
                    <div class="relative group overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 h-56 shadow-xl">
                        <img src="{{ asset('Fasilitas (Tentang Kami)/Rectangle-6.png') }}" alt="Court Tenis Outdoor" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute bottom-4 left-4 bg-slate-950/80 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-white border border-slate-700/50 shadow-md">
                            Lapangan Tenis
                        </div>
                    </div>

                    <!-- Card 2: Arena Futsal Pro -->
                    <div class="relative group overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 h-56 shadow-xl">
                        <img src="{{ asset('Fasilitas (Tentang Kami)/Rectangle 9.png') }}" alt="Arena Futsal Pro" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                        <div class="absolute bottom-4 left-4 bg-slate-950/80 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-white border border-slate-700/50 shadow-md">
                           Lapangan Futsal
                        </div>
                    </div>

                    <!-- Card 3: Mini Soccer Turf -->
                    <div class="relative group overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 h-56 shadow-xl">
                        <img src="{{ asset('Fasilitas (Tentang Kami)/Rectangle 7.png') }}" alt="Mini Soccer Turf" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                        <div class="absolute bottom-4 left-4 bg-slate-950/80 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-white border border-slate-700/50 shadow-md">
                            Lapangan MiniSoccer
                        </div>
                    </div>

                    <!-- Card 4: Badminton Hall -->
                    <div class="relative group overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 h-56 shadow-xl">
                        <img src="{{ asset('Fasilitas (Tentang Kami)/Rectangle 10.png') }}" alt="Badminton Hall" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                        <div class="absolute bottom-4 left-4 bg-slate-950/80 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-white border border-slate-700/50 shadow-md">
                            Lapangan Badminton
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Rekomendasi Olahraga Section --}}
        <section id="lapangan" class="w-full py-16 lg:py-24 px-6 sm:px-8 lg:px-16 bg-[#0F172A] border-b border-slate-800/80">
            <div class="w-full max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-end mb-12 gap-4">
                    <div>
                        <span class="inline-block px-3 py-1 mb-2 text-xs font-semibold bg-[#84CC16]/10 text-[#65A30D] border border-[#84CC16]/20 rounded-full tracking-wider uppercase">Pilihan Terbaik</span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white">Rekomendasi Olahraga</h2>
                    </div>
                    <p class="text-slate-400 text-sm sm:text-base max-w-lg lg:text-right">
                        Temukan lapangan standar internasional dan berbagai cabang olahraga populer dengan fasilitas terlengkap.
                    </p>
                </div>

                <!-- Grid Kartu Olahraga (Tanpa Array PHP, Langsung HTML Manual) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Card 1: Mini Soccer -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Mini Soccer.png') }}" alt="Mini Soccer" class="w-full h-full object-cover object-bottom group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Mini Soccer</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Rumput sintetis FIFA standard</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 2: Badminton -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Badminton.png') }}" alt="Badminton" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Badminton</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Karpet vinyl anti-slip & lighting LED</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 3: Padel -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Padel.png') }}" alt="Padel" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Padel</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Panorama glass wall outdoor</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 4: Basket -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Basket.png') }}" alt="Basket" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Basket</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Lapangan kayu parquet & outdoor</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 5: Futsal -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Futsal.png') }}" alt="Futsal" class="w-full h-full object-cover object-bottom group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Futsal</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Lantai interlock & rumput sintetis</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 6: Sepak Bola -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Sepak Bola.png') }}" alt="Sepak Bola" class="w-full h-full object-cover object-bottom group-hover:scale-105 transition duration-500 mb-50">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Sepak Bola</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Stadion outdoor rumput alami & sintetis</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 7: Tenis  -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Tenis.png') }}" alt="Tenis" class="w-full h-full object-cover object-bottom group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Tenis</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Hard court & clay court berstandar</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 8: Renang -->
                    <a href="#" class="bg-slate-900/80 border border-slate-800 rounded-3xl overflow-hidden hover:border-[#84CC16]/50 transition group flex flex-col justify-between shadow-xl block">
                        <div>
                            <div class="h-48 relative overflow-hidden bg-slate-800">
                                <img src="{{ asset('Rekomendasi Olahraga/Renang.png') }}" alt="Renang" class="w-full h-full object-cover object-bottom group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 right-3 text-[10px] px-3 py-1 bg-[#84CC16] text-slate-950 font-extrabold rounded-full tracking-wider shadow-md uppercase">TERSEDIA</span>
                            </div>
                            <div class="p-5 flex items-end justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-white group-hover:text-[#84CC16] transition">Renang</h3>
                                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">Kolam olympic semi-indoor & outdoor</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-300 group-hover:bg-[#84CC16] group-hover:text-slate-950 transition duration-300 shrink-0 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </section>

        {{-- FAQ Section --}}
        <section class="w-full py-16 lg:py-24 px-6 sm:px-8 lg:px-16 bg-[#F8FAFC]">
            <div class="w-full max-w-5xl mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="inline-block px-3 py-1 mb-2 text-xs font-semibold bg-[#84CC16]/10 text-[#65A30D] border border-[#84CC16]/20 rounded-full tracking-wider uppercase">Tanya Jawab Umum</span>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight mb-3 text-[#0F172A]">
                        FAQ Seputar WANGI<span class="text-[#65A30D]">SPORT</span>
                    </h2>
                    <p class="text-[#475569] text-sm sm:text-base">Punya pertanyaan seputar proses booking, venue, atau pembayaran? Temukan jawabannya di sini.</p>
                </div>

                <div class="space-y-4">
                    @php
                    $faqs = [
                    ['q' => 'Apa kelebihan sewa lapangan yang tersedia di WANGISPORT?', 'a' => 'WANGISPORT menyediakan sistem booking lapangan secara online, konfirmasi otomatis, pilihan venue berkualitas tinggi, serta jaminan jadwal langsung tanpa antre.'],
                    ['q' => 'Bagaimana cara memesan lapangan di WANGISPORT?', 'a' => 'Cukup pilih menu lapangan, tentukan venue dan jadwal tanggal/jam yang kosong, lalu lanjutkan ke pembayaran instan.'],
                    ['q' => 'Bagaimana cara menemukan lapangan yang sesuai dengan kebutuhan saya?', 'a' => 'Anda dapat memfilter rekomendasi olahraga berdasarkan jenis fasilitas, lokasi venue, atau standar internasional yang diinginkan.'],
                    ['q' => 'Bagaimana proses pengajuan pembatalan booking untuk lapangan?', 'a' => 'Pembatalan dapat diajukan melalui pusat bantuan atau riwayat pesanan dengan mengikuti ketentuan kebijakan masing-masing venue partner.'],
                    ['q' => 'Apakah ada diskon atau promo khusus untuk penyewa lapangan di WANGISPORT?', 'a' => 'Tentu! Kami menyediakan berbagai penawaran diskon khusus member setia dan promo menarik di hari-hari tertentu.'],
                    ];
                    @endphp

                    @foreach($faqs as $faq)
                    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-6 transition hover:border-slate-700">
                        <div class="flex justify-between items-center cursor-pointer">
                            <h3 class="font-semibold text-base sm:text-lg text-white">{{ $faq['q'] }}</h3>
                            <span class="text-slate-400 text-lg font-bold ml-4">&#9662;</span>
                        </div>
                        <p class="text-slate-400 text-sm mt-3 leading-relaxed border-t border-slate-800/60 pt-3">{{ $faq['a'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Call To Action (CTA) Section --}}
        <section class="w-full py-16 px-6 sm:px-8 lg:px-16 bg-[#F8FAFC]">
            <div class="w-full">
                <div class="bg-gradient-to-r from-slate-900 via-slate-900 to-[#0B0F17] border border-slate-800 rounded-3xl p-8 sm:p-12 lg:p-16 text-center relative overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(163,230,53,0.08)_0,transparent_60%)]"></div>
                    <div class="relative z-10 max-w-2xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 text-white">Siap Bertanding Hari Ini?</h2>
                        <p class="text-slate-400 text-base sm:text-lg mb-8 leading-relaxed">
                            Jangan biarkan rencana jadwal sempat terlewat! Amankan arena latihanmu sekarang dan rasakan pengalaman booking anti-ribet.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="#lapangan" class="px-8 py-4 bg-[#65A30D] text-white font-bold rounded-xl hover:bg-[#84CC16] transition shadow-lg shadow-[#65A30D]/10">
                                Pesan Lapangan Sekarang
                            </a>
                            <a href="#tentang" class="px-8 py-4 bg-slate-900 text-white font-medium rounded-xl hover:bg-slate-800 transition border border-slate-800">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.customer>