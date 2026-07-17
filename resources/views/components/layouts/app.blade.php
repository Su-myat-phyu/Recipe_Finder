<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="recipeFinderTheme()" x-bind:class="{ dark: darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Recipe Finder' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-950 antialiased transition-colors duration-300 dark:bg-[#101827] dark:text-white">
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute left-[-10%] top-[-12%] h-96 w-96 rounded-full bg-[#4CAF50]/20 blur-3xl"></div>
            <div class="absolute right-[-8%] top-[18%] h-96 w-96 rounded-full bg-[#FF7043]/20 blur-3xl"></div>
            <div class="absolute bottom-[-14%] left-[30%] h-96 w-96 rounded-full bg-[#FFD54F]/20 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,.82),rgba(248,250,252,.72)_34%,rgba(248,250,252,.95)_74%)] dark:bg-[radial-gradient(circle_at_top,rgba(76,175,80,.15),rgba(16,24,39,.82)_36%,rgba(16,24,39,1)_80%)]"></div>
        </div>

        <x-nav />

        <main>
            {{ $slot }}
        </main>
    </body>
</html>
