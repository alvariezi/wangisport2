@extends('layouts.tenant')

@section('content')
@php($days = [1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu',7=>'Minggu'])
<div class="space-y-6 pb-10">
    <div>
        <a href="{{ route('tenant.dashboard') }}" class="text-xs text-emerald-400">← Dashboard Tenant</a>
        <h1 class="mt-2 text-2xl font-extrabold text-white">Jadwal & Harga — {{ $court->name }}</h1>
        <p class="mt-1 text-sm text-zinc-400">Atur slot mingguan untuk lapangan milik {{ $tenant->display_name }}.</p>
    </div>

    @if(session('success'))<div class="rounded-xl border border-emerald-700 bg-emerald-950 p-4 text-sm text-emerald-300">{{ session('success') }}</div>@endif
    @if($errors->any())
        <div class="rounded-xl border border-red-800 bg-red-950 p-4 text-sm text-red-200"><strong>Periksa input:</strong><ul class="mt-2 list-disc pl-4">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="grid gap-6 lg:grid-cols-3">
        <section class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5 lg:col-span-1">
            <h2 class="font-bold text-white">Tambah Slot</h2>
            <form action="{{ route('tenant.courts.schedule.store', $court) }}" method="POST" class="mt-5 space-y-4">@csrf
                <label class="block text-xs text-zinc-300">Hari
                    <select name="day_of_week" required class="mt-1 w-full rounded-lg border border-zinc-700 bg-zinc-950 p-3 text-white">@foreach($days as $id=>$day)<option value="{{ $id }}" @selected(old('day_of_week') == $id)>{{ $day }}</option>@endforeach</select>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="block text-xs text-zinc-300">Mulai<input type="time" name="start_time" required value="{{ old('start_time') }}" class="mt-1 w-full rounded-lg border border-zinc-700 bg-zinc-950 p-3 text-white"></label>
                    <label class="block text-xs text-zinc-300">Selesai<input type="time" name="end_time" required value="{{ old('end_time') }}" class="mt-1 w-full rounded-lg border border-zinc-700 bg-zinc-950 p-3 text-white"></label>
                </div>
                <label class="block text-xs text-zinc-300">Harga (Rp)<input type="number" name="base_price" min="0" required value="{{ old('base_price') }}" placeholder="100000" class="mt-1 w-full rounded-lg border border-zinc-700 bg-zinc-950 p-3 text-white"></label>
                <input type="hidden" name="is_available" value="0"><label class="flex gap-2 text-sm text-zinc-300"><input type="checkbox" name="is_available" value="1" checked> Tersedia</label>
                <input type="hidden" name="is_peak_rate" value="0"><label class="flex gap-2 text-sm text-zinc-300"><input type="checkbox" name="is_peak_rate" value="1"> Tarif Peak Hour</label>
                <button class="w-full rounded-xl bg-emerald-500 px-4 py-3 text-sm font-bold text-zinc-950 hover:bg-emerald-400">Simpan Jadwal</button>
            </form>
        </section>
        <section class="space-y-3 rounded-2xl border border-zinc-800 bg-zinc-900 p-5 lg:col-span-2">
            <h2 class="mb-4 font-bold text-white">Daftar Jadwal Mingguan</h2>
            @forelse($timeslots as $slot)
                <div class="rounded-xl border border-zinc-800 bg-zinc-950 p-4">
                    <form method="POST" action="{{ route('tenant.courts.schedule.update', [$court, $slot]) }}" class="grid gap-3 md:grid-cols-6">@csrf @method('PUT')
                        <select name="day_of_week" required class="rounded-lg border border-zinc-700 bg-zinc-900 p-2 text-xs text-white">@foreach($days as $id=>$day)<option value="{{ $id }}" @selected($slot->day_of_week == $id)>{{ $day }}</option>@endforeach</select>
                        <input type="time" name="start_time" value="{{ substr($slot->start_time,0,5) }}" required class="min-w-0 rounded-lg border border-zinc-700 bg-zinc-900 p-2 text-xs text-white">
                        <input type="time" name="end_time" value="{{ substr($slot->end_time,0,5) }}" required class="min-w-0 rounded-lg border border-zinc-700 bg-zinc-900 p-2 text-xs text-white">
                        <input type="number" min="0" name="base_price" value="{{ $slot->base_price }}" required class="min-w-0 rounded-lg border border-zinc-700 bg-zinc-900 p-2 text-xs text-white">
                        <div class="space-y-1 text-xs text-zinc-300"><input type="hidden" name="is_available" value="0"><label class="block"><input type="checkbox" name="is_available" value="1" @checked($slot->is_available)> Tersedia</label><input type="hidden" name="is_peak_rate" value="0"><label class="block"><input type="checkbox" name="is_peak_rate" value="1" @checked($slot->is_peak_rate)> Peak</label></div>
                        <button class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-bold text-white hover:bg-indigo-500">Update</button>
                    </form>
                    <form method="POST" action="{{ route('tenant.courts.schedule.destroy', [$court, $slot]) }}" class="mt-2 text-right">@csrf @method('DELETE')<button class="text-xs font-semibold text-red-400 hover:text-red-300">Hapus Slot</button></form>
                </div>
            @empty
                <p class="rounded-xl border border-dashed border-zinc-700 p-8 text-center text-sm text-zinc-400">Belum ada slot. Gunakan form Tambah Slot.</p>
            @endforelse
        </section>
    </div>
</div>
@endsection
