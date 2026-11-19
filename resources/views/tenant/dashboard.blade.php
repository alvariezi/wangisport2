@extends('layouts.tenant')

@section('content')
<div class="space-y-7 pb-10">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-emerald-400">Portal Tenant Wangisport</div>
            <h1 class="mt-2 text-3xl font-extrabold text-white">{{ $tenant->display_name }}</h1>
            <p class="mt-1 text-sm text-zinc-400">Lokasi: {{ $tenant->venue?->name ?? 'Belum ditentukan' }}</p>
        </div>
        <a href="{{ route('tenant.courts.manage.create') }}" class="rounded-xl bg-emerald-500 px-5 py-3 text-sm font-bold text-zinc-950 hover:bg-emerald-400">+ Tambah Lapangan</a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach([
            ['label'=>'Total Lapangan','value'=>$totalCourts,'color'=>'text-white'],
            ['label'=>'Lapangan Aktif','value'=>$activeCourts,'color'=>'text-emerald-400'],
            ['label'=>'Rata-rata Harga Slot','value'=>'Rp '.number_format($overallAveragePrice,0,',','.'),'color'=>'text-indigo-400'],
        ] as $stat)
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">
                <p class="text-xs font-bold uppercase text-zinc-400">{{ $stat['label'] }}</p>
                <p class="mt-4 text-3xl font-black {{ $stat['color'] }}">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid gap-5 lg:grid-cols-3">
        <section class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6 lg:col-span-2">
            <h2 class="text-lg font-extrabold text-white">Grafik Analisis Harga Lapangan</h2>
            <p class="mt-1 text-xs text-zinc-400">Rata-rata harga semua timeslot per lapangan.</p>
            <div class="mt-7 space-y-5">
                @forelse($priceChart as $item)
                    @php($width = max(0, min(100, ($item['average_price'] / $chartMax) * 100)))
                    <div>
                        <div class="mb-2 flex justify-between gap-3 text-sm"><span class="text-zinc-200">{{ $item['name'] }}</span><span class="font-semibold text-emerald-400">Rp {{ number_format($item['average_price'], 0, ',', '.') }}</span></div>
                        <div class="h-3 rounded-full bg-zinc-800"><div class="h-3 rounded-full bg-gradient-to-r from-emerald-600 to-lime-400" style="width: {{ $width }}%"></div></div>
                    </div>
                @empty
                    <p class="rounded-xl border border-dashed border-zinc-700 p-8 text-center text-sm text-zinc-400">Belum ada lapangan untuk dianalisis.</p>
                @endforelse
            </div>
        </section>
        <div class="space-y-4">
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"><div class="text-xs uppercase text-zinc-400">Harga Terendah</div><div class="mt-3 text-2xl font-extrabold text-emerald-400">Rp {{ number_format($lowestPrice,0,',','.') }}</div></div>
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"><div class="text-xs uppercase text-zinc-400">Harga Tertinggi</div><div class="mt-3 text-2xl font-extrabold text-indigo-400">Rp {{ number_format($highestPrice,0,',','.') }}</div></div>
            <a href="{{ route('tenant.courts.manage') }}" class="block rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-5 text-sm font-bold text-emerald-400">Kelola Semua Lapangan →</a>
        </div>
    </div>

    <section class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">
        <h2 class="mb-5 text-lg font-extrabold text-white">Lapangan Saya</h2>
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @forelse($courts as $court)
                <article class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-950">
                    <img src="{{ $court->gambar ? asset('storage/'.$court->gambar) : asset('rectangle-6.png') }}" alt="{{ $court->name }}" class="h-40 w-full object-cover">
                    <div class="p-4">
                        <div class="flex justify-between gap-3"><h3 class="font-bold text-white">{{ $court->name }}</h3><span class="text-xs {{ $court->is_active ? 'text-emerald-400' : 'text-red-400' }}">{{ $court->is_active ? 'Aktif' : 'Nonaktif' }}</span></div>
                        <p class="mt-1 text-xs text-zinc-500">{{ ucfirst($court->type) }} • {{ $court->surface_type ?? 'Permukaan belum diisi' }}</p>
                        <p class="mt-3 text-xs text-zinc-400">Tarif: Rp {{ number_format($court->min_price ?? 0,0,',','.') }} – Rp {{ number_format($court->max_price ?? 0,0,',','.') }}</p>
                        <a href="{{ route('tenant.courts.schedule', $court) }}" class="mt-4 block rounded-xl bg-emerald-500 px-4 py-3 text-center text-xs font-bold text-zinc-950 hover:bg-emerald-400">Atur Jadwal & Harga</a>
                    </div>
                </article>
            @empty
                <p class="text-sm text-zinc-400">Belum ada lapangan. Tambahkan melalui menu Kelola Lapangan.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
