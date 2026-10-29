<x-layouts.admin title="Edit Skema Komisi">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Edit Skema Komisi</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                Perbarui nilai komisi {{ $commission->tenant ? 'khusus ' . $commission->tenant->display_name : 'Default Platform (Global)' }}
            </p>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <form action="{{ route('admin.commissions.update', $commission) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Target Komisi (Read-Only) -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Target Komisi</label>
                    <input type="text" readonly value="{{ $commission->tenant ? $commission->tenant->display_name . ' (' . ($commission->tenant->venue?->name ?? 'Tanpa Venue') . ')' : 'Komisi Default Platform (Global)' }}" class="w-full rounded-xl border border-zinc-200 bg-zinc-100 px-3.5 py-2.5 text-sm font-semibold text-zinc-700 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300 cursor-not-allowed">
                </div>

                <!-- Tarif Komisi -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Tarif Komisi (%)</label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" max="100" name="commission_rate" value="{{ old('commission_rate', $commission->commission_rate) }}" required class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 pr-8 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <span class="absolute right-3 top-2.5 text-sm font-bold text-zinc-400">%</span>
                    </div>
                    @error('commission_rate')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Catatan Perubahan -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Catatan / Alasan Perubahan</label>
                    <input type="text" name="notes" value="{{ old('notes', $commission->notes) }}" placeholder="Catatan perubahan komisi" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.commissions.index') }}" class="rounded-xl bg-zinc-100 px-4 py-2.5 text-xs font-semibold text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">Batal</a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-500">Perbarui Komisi</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>