<x-layouts.app title="Profile">
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-[.2em] text-[#4CAF50]">Account</p>
            <h1 class="mt-2 text-4xl font-extrabold">Profile settings</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">Manage your identity, password, and Recipe Finder account access.</p>
        </div>

        <div class="grid gap-6">
            <section class="glass-panel p-6 sm:p-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold">Profile information</h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Update your name and email address.</p>
                    </div>
                    @if (session('status') === 'profile-updated')
                        <span class="validation-pop rounded-full bg-[#4CAF50]/10 px-4 py-2 text-sm font-bold text-[#2f7d32] dark:text-[#8ee094]">Saved</span>
                    @endif
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="mt-6 grid gap-5 md:grid-cols-2">
                    @csrf
                    @method('PATCH')

                    <x-input label="Name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" />
                    <x-input label="Email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email" />

                    @if (! $user->hasVerifiedEmail())
                        <div class="md:col-span-2 rounded-3xl border border-[#FFD54F]/30 bg-[#FFD54F]/15 p-4 text-sm font-semibold text-[#8a6b00] dark:text-[#ffe28a]">
                            Your email address is unverified. Please contact support if you need help verifying it.
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <x-button type="submit">Save profile</x-button>
                    </div>
                </form>
            </section>

            <section class="glass-panel p-6 sm:p-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold">Password</h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Use a strong password you do not reuse elsewhere.</p>
                    </div>
                    @if (session('status') === 'password-updated')
                        <span class="validation-pop rounded-full bg-[#4CAF50]/10 px-4 py-2 text-sm font-bold text-[#2f7d32] dark:text-[#8ee094]">Updated</span>
                    @endif
                </div>

                <form method="POST" action="{{ route('profile.password') }}" class="mt-6 grid gap-5 md:grid-cols-3">
                    @csrf
                    @method('PUT')

                    <x-input label="Current password" name="current_password" type="password" autocomplete="current-password" required />
                    <x-input label="New password" name="password" type="password" autocomplete="new-password" required />
                    <x-input label="Confirm password" name="password_confirmation" type="password" autocomplete="new-password" required />

                    <div class="md:col-span-3">
                        <x-button type="submit">Update password</x-button>
                    </div>
                </form>
            </section>

            <section class="glass-panel border-[#FF7043]/20 p-6 sm:p-8">
                <h2 class="text-2xl font-extrabold">Delete account</h2>
                <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">This permanently removes your profile, saved recipes, and search history.</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end">
                    @csrf
                    @method('DELETE')

                    <div class="flex-1">
                        <x-input label="Confirm with password" name="password" type="password" autocomplete="current-password" required />
                    </div>
                    <x-button variant="secondary" type="submit">Delete account</x-button>
                </form>
            </section>
        </div>
    </section>
</x-layouts.app>
