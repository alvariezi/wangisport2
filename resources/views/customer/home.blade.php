<x-layouts.customer :title="'Venue: '.$venue">
    <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <h1 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Selamat Datang di {{ $venue }}</h1>
        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
            Katalog lapangan dan jadwal interaktif (*Calendar Booking Board*) untuk venue <span class="font-semibold text-emerald-600">{{ $venue }}</span> akan ditampilkan di sini.
        </p>
    </div>
</x-layouts.customer>