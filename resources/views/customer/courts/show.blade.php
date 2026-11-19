<x-layouts.customer :title="'Detail Lapangan - Wangisport'">
    @php
        $hari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
    @endphp

    <section class="bg-[#0B2416] px-6 py-10 text-white sm:px-8 lg:px-16">
        <div class="mx-auto max-w-7xl">
            <a href="{{ route('customer.catalog') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-lime-300 hover:text-lime-200">
                &larr; Kembali ke Daftar Lapangan
            </a>
            <p class="text-xs font-bold uppercase tracking-widest text-lime-300">Detail Lapangan Wangisport</p>
            <h1 class="mt-2 text-3xl font-black uppercase tracking-tight sm:text-4xl">{{ $courtData->court_name }}</h1>
            <p class="mt-3 text-sm text-slate-300">{{ $courtData->venue_name }} &middot; {{ $courtData->tenant_name }}</p>
        </div>
    </section>

    <section class="bg-[#F8FAFC] px-6 py-10 text-slate-900 sm:px-8 lg:px-16">
        <div class="mx-auto grid max-w-7xl gap-7 lg:grid-cols-5">
            <div class="space-y-5 lg:col-span-3">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-sm">
                    <img src="{{ $courtData->gambar ? asset('storage/' . $courtData->gambar) : asset('rectangle-6.png') }}"
                         alt="Foto {{ $courtData->court_name }}"
                         class="h-64 w-full object-cover sm:h-96"
                         onerror="this.onerror=null;this.src='{{ asset('rectangle-6.png') }}';">
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-extrabold">Informasi Lapangan</h2>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div><p class="text-xs text-slate-500">Jenis olahraga</p><p class="mt-1 font-bold capitalize">{{ $courtData->type }}</p></div>
                        <div><p class="text-xs text-slate-500">Jenis permukaan</p><p class="mt-1 font-bold">{{ $courtData->surface_type ?: 'Belum ditentukan' }}</p></div>
                        <div><p class="text-xs text-slate-500">Venue</p><p class="mt-1 font-bold">{{ $courtData->venue_name }}</p></div>
                        <div><p class="text-xs text-slate-500">Pengelola</p><p class="mt-1 font-bold">{{ $courtData->tenant_name }}</p></div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold">Jam Tersedia & Harga</h2>
                            <p class="mt-1 text-xs text-slate-500">Jadwal rutin yang dibuka oleh pengelola lapangan</p>
                        </div>
                        <span class="shrink-0 rounded-full bg-lime-100 px-3 py-1 text-xs font-bold text-lime-800">{{ $timeslots->count() }} slot</span>
                    </div>

                    @if(!is_null($startingPrice))
                        <div class="mt-5 rounded-xl bg-lime-50 p-4">
                            <p class="text-xs font-medium text-slate-500">Harga mulai dari</p>
                            <p class="mt-1 text-2xl font-black text-slate-900">Rp {{ number_format($startingPrice, 0, ',', '.') }}</p>
                            <p class="mt-1 text-xs text-slate-500">Per slot sesuai durasi yang tercantum</p>
                        </div>
                    @endif

                    @if($timeslots->isEmpty())
                        <div class="mt-6 rounded-xl border border-dashed border-slate-300 p-6 text-center">
                            <p class="font-bold">Belum ada jadwal tersedia</p>
                            <p class="mt-2 text-sm text-slate-500">Pengelola belum membuka jam dan harga untuk lapangan ini.</p>
                        </div>
                    @else
                        <div class="mt-5 space-y-3">
                            @foreach($timeslots as $slot)
                                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-slate-200 p-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase text-emerald-700">
                                            {{ $slot->day_of_week === null ? 'Hari belum ditentukan' : ($hari[(int) $slot->day_of_week] ?? 'Hari tidak diketahui') }}
                                        </p>
                                        <p class="mt-1 font-extrabold text-slate-900">{{ substr((string) $slot->start_time, 0, 5) }} – {{ substr((string) $slot->end_time, 0, 5) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-base font-black text-slate-900">Rp {{ number_format($slot->base_price, 0, ',', '.') }}</p>
                                        <span class="text-[11px] font-medium text-emerald-600">Tersedia</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <p class="mt-5 text-xs leading-relaxed text-slate-500">Jadwal di atas adalah pengaturan ketersediaan rutin, bukan konfirmasi bahwa slot masih kosong pada tanggal tertentu. Harga dapat berubah sesuai kebijakan pengelola.</p>
                    <a href="{{ route('customer.catalog') }}" class="mt-5 block rounded-xl bg-slate-900 px-5 py-3 text-center text-sm font-bold text-white transition hover:bg-lime-500 hover:text-slate-950">Lihat Lapangan Lain</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.customer>
