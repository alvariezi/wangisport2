<x-layouts::auth.split :title="'Masuk ke Wangisport'">
    <div class="mb-9 space-y-3">
        <div class="inline-flex items-center rounded-full border border-lime-400/20 bg-lime-400/10 px-3 py-1 text-[11px] font-bold tracking-widest text-lime-400">SELAMAT DATANG KEMBALI</div>
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Masuk ke akun Anda</h2>
        <p class="text-sm leading-6 text-zinc-400">Gunakan email dan password yang sudah terdaftar di Wangisport.</p>
    </div>

    <x-auth-session-status class="mb-5 text-center" :status="session('status')" />
    <x-passkey-verify />

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf
        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-zinc-200">Alamat Email</label>
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/></svg>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus placeholder="nama@email.com" class="block w-full rounded-xl border border-zinc-700 bg-zinc-900/90 py-3.5 pl-12 pr-4 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-lime-400 focus:ring-2 focus:ring-lime-400/15" />
            </div>
            @error('email') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between gap-3">
                <label for="password" class="block text-sm font-semibold text-zinc-200">Password</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-lime-400 hover:text-lime-300">Lupa password?</a>
                @endif
            </div>
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="11" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 118 0v3"/></svg>
                <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Masukkan password" class="block w-full rounded-xl border border-zinc-700 bg-zinc-900/90 py-3.5 pl-12 pr-14 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-lime-400 focus:ring-2 focus:ring-lime-400/15" />
                <button type="button" id="toggle-password" aria-label="Tampilkan password" aria-pressed="false" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1.5 text-xs font-semibold text-zinc-400 hover:text-lime-400">Lihat</button>
            </div>
            @error('password') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <label class="flex cursor-pointer items-center gap-3 text-sm text-zinc-400">
            <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-zinc-600 bg-zinc-900 accent-lime-400" />
            Ingat saya di perangkat ini
        </label>

        <button type="submit" data-test="login-button" class="group flex w-full items-center justify-center gap-2 rounded-xl bg-lime-400 px-5 py-3.5 text-sm font-extrabold text-[#092817] shadow-lg shadow-lime-400/10 transition hover:bg-lime-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-400">
            Masuk ke Dashboard
            <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
        </button>
    </form>

    @if(Route::has('register'))
        <p class="mt-7 text-center text-sm text-zinc-400">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-lime-400 hover:text-lime-300">Daftar di sini</a></p>
    @endif

    <div class="mt-9 border-t border-white/10 pt-5 text-center text-xs leading-5 text-zinc-500">
        Login aman untuk pengelola platform dan operator venue Wangisport.
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('password');
            const button = document.getElementById('toggle-password');
            if (!input || !button) return;
            button.addEventListener('click', function () {
                const visible = input.type === 'password';
                input.type = visible ? 'text' : 'password';
                button.textContent = visible ? 'Tutup' : 'Lihat';
                button.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Tampilkan password');
                button.setAttribute('aria-pressed', visible ? 'true' : 'false');
            });
        });
    </script>
</x-layouts::auth.split>
