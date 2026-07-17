<x-auth-shell title="Choose new password" subtitle="Create a fresh password for your Recipe Finder account.">
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-auth-input label="Email address" name="email" type="email" value="{{ old('email', $request->email) }}" autocomplete="email" required />
        <x-auth-input label="New password" name="password" type="password" autocomplete="new-password" required autofocus />
        <x-auth-input label="Confirm new password" name="password_confirmation" type="password" autocomplete="new-password" required />

        <button class="auth-button w-full" type="submit">
            Update password
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/></svg>
        </button>
    </form>
</x-auth-shell>
