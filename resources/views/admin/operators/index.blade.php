
<x-layouts.admin title="Manajemen Operator">

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                    Manajemen Operator
                </h1>

                <p class="mt-1 text-sm text-zinc-500">
                    Kelola akun operator yang terhubung dengan venue Wangisport.
                </p>
            </div>

            <span class="rounded-xl bg-indigo-500/10 px-4 py-2 text-sm font-bold text-indigo-400">
                {{ $operators->total() }} Operator
            </span>

        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- PENCARIAN --}}
        <form method="GET"
              action="{{ route('admin.operators.index') }}"
              class="rounded-2xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900">

            <div class="flex flex-col gap-3 sm:flex-row">

                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari operator, email, tenant, atau venue..."
                    class="min-w-0 flex-1 rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 outline-none focus:border-indigo-500 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white"
                >

                <button type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-indigo-500">
                    Cari Operator
                </button>

            </div>
        </form>

        {{-- TABEL OPERATOR --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                        <tr>
                            <th class="px-5 py-4">Operator</th>
                            <th class="px-5 py-4">Venue</th>
                            <th class="px-5 py-4">Tenant</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                        @forelse($operators as $operator)

                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/40">

                                {{-- OPERATOR --}}
                                <td class="px-5 py-4">

                                    <div class="font-bold text-zinc-900 dark:text-white">
                                        {{ $operator->operator_name }}
                                    </div>

                                    <div class="mt-1 text-xs text-zinc-500">
                                        {{ $operator->email }}
                                    </div>

                                </td>

                                {{-- VENUE --}}
                                <td class="px-5 py-4 font-medium text-zinc-700 dark:text-zinc-300">
                                    {{ $operator->venue_name }}
                                </td>

                                {{-- TENANT --}}
                                <td class="px-5 py-4 text-zinc-600 dark:text-zinc-400">
                                    {{ $operator->tenant_name }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if($operator->user_status === 'active')
                                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-500">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>

                                {{-- AKSI --}}
                                <td class="px-5 py-4 text-right">

                                    <a href="{{ route('admin.operators.edit', $operator->user_id) }}"
                                       class="inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-indigo-500">
                                        Kelola
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">

                                    <p class="font-semibold text-zinc-900 dark:text-white">
                                        Belum Ada Operator
                                    </p>

                                    <p class="mt-2 text-xs text-zinc-500">
                                        Operator akan muncul setelah akun terhubung dengan tenant venue.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>

        {{-- PAGINATION --}}
        @if($operators->hasPages())
            <div class="pt-2">
                {{ $operators->links() }}
            </div>
        @endif

    </div>

</x-layouts.admin>
