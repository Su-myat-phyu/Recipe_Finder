<x-auth-shell title="Reset password" subtitle="Enter your email and we will send a secure reset link to your inbox.">
    @if (session('status'))
        <div class="mb-5 rounded-3xl border border-[#4CAF50]/30 bg-[#4CAF50]/15 px-4 py-3 text-sm font-semibold text-[#b8f5bb]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <x-auth-input label="Email address" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus />

        <button class="auth-button w-full" type="submit">
            Send reset link
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-9.75 6.75L2.25 6.75"/></svg>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-slate-600 dark:text-white/68">
        Remembered it?
        <a href="{{ route('login') }}" class="font-bold text-slate-900 dark:text-white underline decoration-[#4CAF50] decoration-2 underline-offset-4">Back to login</a>
    </p>
</x-auth-shell>
