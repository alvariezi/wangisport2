
@extends('layouts.tenant')

@section('title', 'Tambah Lapangan Baru')

@section('content')

    <div class="max-w-2xl mx-auto space-y-6">

        <!-- Header Navigation -->
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">

            <div>
                <h1 class="text-xl font-bold text-zinc-100">
                    Tambah Lapangan Baru
                </h1>

                <p class="text-xs text-zinc-400 mt-1">
                    Isi formulir di bawah ini untuk menambahkan unit lapangan baru ke sistem.
                </p>
            </div>

            <a href="{{ route('tenant.courts.manage') }}"
               class="rounded-xl bg-zinc-800 px-4 py-2 text-xs font-semibold text-zinc-300 hover:bg-zinc-700 transition-colors">
                &larr; Kembali
            </a>

        </div>


        <!-- Form Tambah Lapangan -->
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6 shadow-sm">

            <form method="POST"
                  action="{{ route('tenant.courts.store') }}"
                  class="space-y-5 text-xs">

                @csrf

                <!-- Nama Lapangan -->
                <div>
                    <label class="block font-semibold text-zinc-300 mb-1">
                        Nama Lapangan
                        <span class="text-red-400">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           placeholder="Contoh: Lapangan Futsal A"
                           class="w-full rounded-xl border border-zinc-800 bg-zinc-950 px-4 py-3 text-zinc-100 focus:border-emerald-500 focus:outline-none">
                </div>


                <!-- Jenis Cabang Olahraga -->
                <div>
                    <label class="block font-semibold text-zinc-300 mb-1">
                        Jenis Cabang Olahraga
                        <span class="text-red-400">*</span>
                    </label>

                    <select name="type"
                            required
                            class="w-full rounded-xl border border-zinc-800 bg-zinc-950 px-4 py-3 text-zinc-100 focus:border-emerald-500 focus:outline-none">

                        <option value="futsal">
                            Futsal
                        </option>

                        <option value="badminton">
                            Bulutangkis (Badminton)
                        </option>

                        <option value="basket">
                            Bola Basket
                        </option>

                        <option value="padel">
                            Padel
                        </option>

                        <option value="tenis">
                            Tenis
                        </option>

                    </select>
                </div>


                <!-- Jenis Permukaan Lapangan -->
                <div>
                    <label class="block font-semibold text-zinc-300 mb-1">
                        Jenis Permukaan (Ground Surface)
                    </label>

                    <input type="text"
                           name="surface_type"
                           value="{{ old('surface_type') }}"
                           placeholder="Contoh: Rumput Sintetis / Interlock Vinyl"
                           class="w-full rounded-xl border border-zinc-800 bg-zinc-950 px-4 py-3 text-zinc-100 focus:border-emerald-500 focus:outline-none">
                </div>


                <!-- Status Lapangan -->
                <div class="flex items-center gap-2 pt-2">

                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           id="is_active"
                           checked
                           class="rounded border-zinc-800 bg-zinc-950 text-emerald-600 focus:ring-0">

                    <label for="is_active"
                           class="font-semibold text-zinc-300">
                        Aktifkan Lapangan (Langsung Siap Disewa)
                    </label>

                </div>


                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">

                    <a href="{{ route('tenant.courts.manage') }}"
                       class="rounded-xl bg-zinc-800 px-5 py-2.5 font-semibold text-zinc-300 hover:bg-zinc-700 transition-colors">
                        Batal
                    </a>

                    <button type="submit"
                            class="rounded-xl bg-emerald-600 px-5 py-2.5 font-semibold text-white hover:bg-emerald-500">
                        Simpan Lapangan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
