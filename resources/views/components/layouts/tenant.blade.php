@props(['title' => 'Portal Tenant Mitra']) 
<!DOCTYPE html> 
<html lang="id" class="h-full bg-zinc-50 dark:bg-zinc-950"> 
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>{{ $title }} - Portal Tenant Wangisport</title> 
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head> 
<body class="h-full font-sans antialiased text-zinc-900 dark:text-zinc-100"> 
    <div class="min-h-full flex flex-col md:flex-row"> 
        <!-- Sidebar Navigation Khusus Tenant --> 
        <aside class="w-full md:w-64 border-r border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 flex-shrink-0"> 
            <div class="p-6 border-b border-zinc-200/80 dark:border-zinc-800 flex items-center justify-between"> 
                <div> 
                    <h2 class="font-extrabold text-lg text-emerald-600 dark:text-emerald-400">PORTAL TENANT</h2> 
                    <p class="text-[11px] text-zinc-400">Mitra Arena Olahraga</p> 
                </div> 
            </div> 

            <!-- Navigasi Menu Tenant --> 
            <nav class="p-4 space-y-1"> 
                <a href="{{ route('tenant.dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-zinc-900 bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-100"> 
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg> 
                    Dashboard Tenant 
                </a> 
                <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60 transition-colors"> 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 004 0"/>
                    </svg> 
                    Kelola Lapangan 
                </a> 
                <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60 transition-colors"> 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg> 
                    Jadwal & Tarif (Timeslot) 
                </a> 
                <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800/60 transition-colors"> 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg> 
                    Pemesanan Masuk 
                </a> 
            </nav> 

            <div class="p-4 border-t border-zinc-200/80 dark:border-zinc-800 mt-auto"> 
                <div class="px-3 py-2 mb-2"> 
                    <p class="text-xs font-bold text-zinc-800 dark:text-zinc-200">{{ auth()->user()->name }}</p> 
                    <p class="text-[10px] text-emerald-600 font-semibold">Operator Tenant</p> 
                </div> 
                <form method="POST" action="{{ route('logout') }}"> 
                    @csrf 
                    <button type="submit" class="w-full text-left px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 rounded-xl"> 
                        Keluar (Logout) 
                    </button> 
                </form> 
            </div> 
        </aside> 

        <!-- Main Content Area --> 
        <main class="flex-1 p-6 md:p-8"> 
            {{ $slot }} 
        </main> 
    </div> 
</body> 
</html>