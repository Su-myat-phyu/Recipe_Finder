<x-auth-shell title="Create account" subtitle="Build your personal recipe workspace with favorites, history, and smarter cooking ideas.">
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <x-auth-input label="Full name" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus />
        <x-auth-input label="Email address" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required />
        <x-auth-input label="Password" name="password" type="password" autocomplete="new-password" required />
        <x-auth-input label="Confirm password" name="password_confirmation" type="password" autocomplete="new-password" required />

        <button class="auth-button w-full" type="submit">
            Register
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3M7.5 12a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM3 21a6 6 0 0 1 12 0"/></svg>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-slate-600 dark:text-white/68">
        Already have an account?
        <a href="{{ route('login') }}" class="font-bold text-slate-900 dark:text-white underline decoration-[#4CAF50] decoration-2 underline-offset-4">Login</a>
    </p>
</x-auth-shell>
