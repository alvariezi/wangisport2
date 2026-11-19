
{{-- POPUP KONFIRMASI LOGOUT WANGISPORT --}}

<div
    id="logoutModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 p-4 backdrop-blur-sm"
>
    <div
        role="dialog"
        aria-modal="true"
        aria-labelledby="logoutTitle"
        class="w-full max-w-md rounded-2xl border border-zinc-700 bg-zinc-900 p-6 shadow-2xl"
    >
        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/10 text-red-400">
            <svg
                class="h-7 w-7"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <path d="m16 17 5-5-5-5M21 12H9"/>
            </svg>
        </div>

        <h2
            id="logoutTitle"
            class="mb-2 text-xl font-bold text-white"
        >
            Keluar dari Wangisport?
        </h2>

        <p class="mb-6 text-sm leading-relaxed text-zinc-400">
            Apakah Anda yakin ingin keluar dari akun?
            Anda perlu login kembali untuk mengakses dashboard.
        </p>

        <div class="flex justify-end gap-3">
            <button
                type="button"
                id="cancelLogout"
                class="rounded-xl border border-zinc-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-zinc-800"
            >
                Batal
            </button>

            <button
                type="button"
                id="confirmLogout"
                class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
            >
                Ya, Logout
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('logoutModal');
    const cancelButton = document.getElementById('cancelLogout');
    const confirmButton = document.getElementById('confirmLogout');

    let logoutForm = null;

    function openModal(form) {
        logoutForm = form;
        confirmButton.disabled = false;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        cancelButton.focus();
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        logoutForm = null;
    }

    document
        .querySelectorAll('form[data-logout-confirm]')
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                openModal(form);
            });
        });

    cancelButton.addEventListener('click', closeModal);

    confirmButton.addEventListener('click', function () {
        if (logoutForm) {
            confirmButton.disabled = true;
            logoutForm.submit();
        }
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {
            closeModal();
        }
    });
});
</script>
