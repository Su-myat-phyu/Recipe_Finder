@props(['title', 'subtitle' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="recipeFinderTheme()" x-bind:class="{ dark: darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} · Recipe Finder</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-950 antialiased transition-colors duration-300 dark:bg-[#101827] dark:text-white overflow-x-hidden">
        <div class="auth-gradient fixed inset-0 -z-10"></div>
        <div class="auth-overlay fixed inset-0 -z-10"></div>

        <main class="grid min-h-screen px-4 py-8 sm:px-6 lg:grid-cols-[1fr_480px_1fr] lg:px-8">
            <aside class="hidden items-center lg:flex">
                <a href="{{ route('recipes.index') }}" class="group inline-flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-slate-100 text-slate-900 shadow-xl ring-1 ring-slate-200 transition-transform will-change-transform group-hover:scale-105 dark:bg-white/15 dark:text-white dark:shadow-xl dark:ring-white/20">
                        <svg class="h-6 w-6" viewBox="0 0 48 48" fill="none" aria-hidden="true" shape-rendering="geometricPrecision" xmlns="http://www.w3.org/2000/svg">
                            <g fill="currentColor">
                                <path d="M10 9C10 7.9 10.9 7 12 7s2 0.9 2 2v10a5 5 0 0 1-3 4.72V41h-2v-15.28A5 5 0 0 1 6 19V9c0-1.1 0.9-2 2-2s2 0.9 2 2z"/>
                                <path d="M26 7c5.52 0 10 5.38 10 12 0 5.46-3.06 9.86-7.24 11.52V41h-4v-10.48C19.22 30.86 16.42 27.46 16.42 23c0-6.62 4.48-12 10-12z"/>
                            </g>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-lg font-extrabold text-slate-900 dark:text-white">Recipe Finder</span>
                        <span class="block text-sm text-slate-500 dark:text-white/65">Smarter meals, fewer wasted groceries.</span>
                    </span>
                </a>
            </aside>

            <section class="flex items-center justify-center">
                <div class="auth-card w-full max-w-md animate-rise">
                    <div class="mb-8 text-center">
                        <a href="{{ route('recipes.index') }}" class="mx-auto mb-5 grid h-14 w-14 place-items-center rounded-3xl bg-[#4CAF50] text-white shadow-2xl shadow-[#4CAF50]/30 lg:hidden">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 4.5C5 3.67 5.67 3 6.5 3S8 3.67 8 4.5V12a3 3 0 0 1-2 2.83V21H4v-6.17A3 3 0 0 1 2 12V4.5C2 3.67 2.67 3 3.5 3S5 3.67 5 4.5ZM13 3c2.76 0 5 2.69 5 6 0 2.73-1.53 5.03-3.62 5.76V21h-2v-6.24C10.29 14.03 8.76 11.73 8.76 9c0-3.31 2.24-6 5-6H13Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <p class="text-xs font-bold uppercase tracking-[.22em] text-[#FFD54F]">Recipe Finder</p>
                        <h1 class="mt-3 text-3xl font-extrabold tracking-normal sm:text-4xl">{{ $title }}</h1>
                        @if ($subtitle)
                            <p class="mt-3 text-sm leading-7 text-slate-700 dark:text-white/68">{{ $subtitle }}</p>
                        @endif
                    </div>

                    {{ $slot }}
                </div>
            </section>

            <aside class="hidden items-center justify-end lg:flex">
                <button type="button" x-on:click="toggle()" class="rounded-full border border-slate-200 bg-white p-3 text-slate-700 shadow-sm backdrop-blur transition hover:-translate-y-0.5 hover:shadow-md dark:border-white/15 dark:bg-white/10 dark:text-white dark:shadow-xl" aria-label="Toggle dark mode">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A8.5 8.5 0 1 1 11.21 3 6.5 6.5 0 0 0 21 12.79Z"/></svg>
                </button>
            </aside>
        </main>
    </body>
</html>
