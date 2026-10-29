<x-layouts.admin title="Atur Skema Komisi">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Atur Skema Komisi Baru</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Tetapkan persentase komisi global platform atau khusus tenant mitra</p>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <form action="{{ route('admin.commissions.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Target Komisi (Global / Tenant Spesifik) -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Target Penerapan Komisi</label>
                    <select name="tenant_id" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <option value="">-- Komisi Default Platform (Semua Tenant) --</option>
                        @foreach ($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                Khusus: {{ $tenant->display_name }} ({{ $tenant->venue?->name }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-zinc-400 mt-1">Biarkan kosong jika ingin mengubah tarif komisi bawaan seluruh platform.</p>
                </div>

                <!-- Persentase Komisi -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Tarif Komisi (%)</label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" max="100" name="commission_rate" value="{{ old('commission_rate', '15.00') }}" required placeholder="15.00" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 pr-8 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                        <span class="absolute right-3 top-2.5 text-sm font-bold text-zinc-400">%</span>
                    </div>
                    @error('commission_rate')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Catatan Perubahan -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-1">Catatan / Alasan Perubahan</label>
                    <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Contoh: Penyesuaian komisi diskon promo akhir tahun" class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3.5 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.commissions.index') }}" class="rounded-xl bg-zinc-100 px-4 py-2.5 text-xs font-semibold text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300">Batal</a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-500">Simpan Skema Komisi</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>