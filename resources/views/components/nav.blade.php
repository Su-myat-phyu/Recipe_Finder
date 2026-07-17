<header class="sticky top-0 z-50 border-b border-white/40 bg-white/60 backdrop-blur-2xl dark:border-white/10 dark:bg-[#101827]/70">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('recipes.index') }}" class="group flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#4CAF50] text-white shadow-lg shadow-[#4CAF50]/30 transition group-hover:scale-105">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 4.5C5 3.67 5.67 3 6.5 3S8 3.67 8 4.5V12a3 3 0 0 1-2 2.83V21H4v-6.17A3 3 0 0 1 2 12V4.5C2 3.67 2.67 3 3.5 3S5 3.67 5 4.5ZM13 3c2.76 0 5 2.69 5 6 0 2.73-1.53 5.03-3.62 5.76V21h-2v-6.24C10.29 14.03 8.76 11.73 8.76 9c0-3.31 2.24-6 5-6H13Z" fill="currentColor"/>
                </svg>
            </span>
            <span>
                <span class="block text-base font-extrabold leading-tight">Recipe Finder</span>
                <span class="block text-xs font-medium text-slate-500 dark:text-slate-400">Cook from what you have</span>
            </span>
        </a>

        <nav class="flex items-center gap-2">
            <button type="button" x-on:click="toggle()" class="rounded-full border border-slate-200 bg-white/70 p-2.5 text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-[#4CAF50]/50 hover:text-[#4CAF50] dark:border-white/10 dark:bg-white/10 dark:text-white" aria-label="Toggle dark mode">
                <svg x-show="!darkMode" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36 6.36-1.59-1.59M7.23 7.23 5.64 5.64m12.72 0-1.59 1.59M7.23 16.77l-1.59 1.59M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/></svg>
                <svg x-cloak x-show="darkMode" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A8.5 8.5 0 1 1 11.21 3 6.5 6.5 0 0 0 21 12.79Z"/></svg>
            </button>

            @auth
                <a href="{{ route('favorites.index') }}" class="hidden rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white/70 dark:text-slate-200 dark:hover:bg-white/10 sm:inline-flex">Favorites</a>
                <a href="{{ route('dashboard') }}" class="hidden rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white/70 dark:text-slate-200 dark:hover:bg-white/10 sm:inline-flex">Dashboard</a>
                @if (auth()->user()->hasVerifiedEmail())
                    <a href="{{ route('profile.edit') }}" class="hidden rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white/70 dark:text-slate-200 dark:hover:bg-white/10 md:inline-flex">Profile</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-[#FF7043] dark:bg-white dark:text-slate-950">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hidden rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white/70 dark:text-slate-200 dark:hover:bg-white/10 sm:inline-flex">Login</a>
                <a href="{{ route('register') }}" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-[#4CAF50] dark:bg-white dark:text-slate-950">Join free</a>
            @endauth
        </nav>
    </div>
</header>
