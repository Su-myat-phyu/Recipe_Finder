<x-auth-shell title="Verify your email" subtitle="One quick confirmation keeps your recipe workspace secure and ready to sync.">
    @if (session('status') === 'verification-link-sent')
        <div class="mb-5 rounded-3xl border border-[#4CAF50]/30 bg-[#4CAF50]/15 px-4 py-3 text-sm font-semibold text-[#b8f5bb]">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <div class="rounded-[1.75rem] border border-white/12 bg-white/10 p-5 text-sm leading-7 text-slate-700 dark:text-white/72">
        Before continuing, please check your inbox for the verification link. If it did not arrive, please contact support for help.
    </div>

    <div class="mt-6 grid gap-3 sm:grid-cols-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="inline-flex min-h-14 w-full items-center justify-center rounded-full border border-white/15 bg-white/10 px-5 py-3 text-sm font-bold text-slate-900 dark:text-white transition hover:-translate-y-0.5 hover:bg-white/15" type="submit">
                Logout
            </button>
        </form>
    </div>
</x-auth-shell>
