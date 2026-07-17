<x-auth-shell title="Welcome back" subtitle="Sign in to save favorites, revisit searches, and plan meals from your kitchen inventory.">
    @if (session('status'))
        <div class="mb-5 rounded-3xl border border-[#4CAF50]/30 bg-[#4CAF50]/15 px-4 py-3 text-sm font-semibold text-[#b8f5bb]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        <x-auth-input label="Email address" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus />
        <x-auth-input label="Password" name="password" type="password" autocomplete="current-password" required />

        <div class="flex items-center justify-between gap-4">
            <label class="flex items-center gap-3 text-sm font-semibold text-slate-700 dark:text-white/70">
                <input name="remember" value="1" type="checkbox" class="h-5 w-5 rounded-lg border-white/20 bg-white/10 text-[#4CAF50] focus:ring-[#4CAF50]">
                Remember me
            </label>

            <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#FFD54F] transition hover:text-white">Forgot password?</a>
        </div>

        <button class="auth-button w-full" type="submit">
            Login
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-slate-600 dark:text-white/68">
        New to Recipe Finder?
        <a href="{{ route('register') }}" class="font-bold text-slate-900 dark:text-white underline decoration-[#4CAF50] decoration-2 underline-offset-4">Create an account</a>
    </p>
</x-auth-shell>
