@php
    $tenantIdForSidebar = auth()->check()
        ? \Illuminate\Support\Facades\DB::table('user_tenant_roles')
            ->where('user_id', auth()->id())->value('tenant_id')
        : null;
    $sidebarCourts = $tenantIdForSidebar
        ? \App\Models\Court::where('tenant_id', $tenantIdForSidebar)->orderBy('name')->get()
        : collect();
@endphp

<div class="px-4 pb-4">
    <div class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-zinc-500">Jadwal & Harga Lapangan</div>
    <div class="space-y-1">
        @forelse($sidebarCourts as $sidebarCourt)
            <a href="{{ route('tenant.courts.schedule', $sidebarCourt) }}"
               class="flex items-center gap-2 rounded-xl px-3 py-2 text-xs transition {{ request()->routeIs('tenant.courts.schedule*') && request()->route('court')?->id == $sidebarCourt->id ? 'bg-emerald-500/10 text-emerald-400' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white' }}">
                <span class="text-emerald-400">▦</span>
                <span class="truncate">{{ $sidebarCourt->name }}</span>
            </a>
        @empty
            <p class="px-3 py-2 text-xs text-zinc-500">Belum ada lapangan</p>
        @endforelse
    </div>
</div>
