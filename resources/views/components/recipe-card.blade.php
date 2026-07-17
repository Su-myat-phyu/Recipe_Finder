@props(['recipe', 'favorited' => false])

@php
    $favoriteState = $favorited || (auth()->check() && auth()->user()->favoriteRecipes()->where('spoonacular_id', $recipe['id'])->exists());
@endphp

<article class="group overflow-hidden rounded-[2rem] border border-white/60 bg-white/75 shadow-[0_24px_80px_rgba(15,23,42,0.08)] backdrop-blur-2xl transition duration-300 hover:-translate-y-1 hover:shadow-[0_32px_100px_rgba(76,175,80,0.16)] dark:border-white/10 dark:bg-white/10 dark:shadow-black/20">
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-200 dark:bg-white/10">
        @if ($recipe['image'])
            <img src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-transparent to-transparent"></div>
        <div class="absolute left-4 top-4 rounded-full bg-white/85 px-3 py-1 text-xs font-bold text-slate-900 backdrop-blur dark:bg-[#101827]/80 dark:text-white">
            {{ $recipe['used_ingredients'] }} used · {{ $recipe['missed_ingredients'] }} missing
        </div>
        <div class="absolute bottom-4 left-4 rounded-full border border-white/40 bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white backdrop-blur">
            Curated pick
        </div>
        @auth
            <button type="button"
                class="favorite-toggle absolute right-4 top-4 inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/50 bg-white/80 text-lg shadow-lg backdrop-blur transition hover:scale-110 dark:border-white/10 dark:bg-slate-900/70"
                data-recipe-id="{{ $recipe['id'] }}"
                data-favorited="{{ $favoriteState ? '1' : '0' }}"
                data-title="{{ $recipe['title'] }}"
                data-image-url="{{ $recipe['image'] }}"
                data-ready-in-minutes="{{ $recipe['ready_in_minutes'] ?? '' }}"
                data-servings="{{ $recipe['servings'] ?? '' }}"
                data-source-url="{{ $recipe['source_url'] ?? '' }}"
                data-summary="{{ $recipe['summary'] ?? '' }}"
                aria-label="{{ $favoriteState ? 'Remove from favorites' : 'Save to favorites' }}">
                <span class="favorite-icon {{ $favoriteState ? 'text-[#FF5A5F]' : 'text-slate-600 dark:text-slate-200' }} transition-all duration-300">
                    {{ $favoriteState ? '♥' : '♡' }}
                </span>
            </button>
        @endauth
    </div>
    <a href="{{ route('recipes.show', $recipe['id']) }}" class="block p-5">
        <h3 class="line-clamp-2 min-h-14 text-lg font-bold leading-snug text-slate-950 transition group-hover:text-[#2f7d32] dark:text-white dark:group-hover:text-[#8ee094]">{{ $recipe['title'] }}</h3>
        <div class="mt-4 grid grid-cols-3 gap-2 text-center text-xs font-semibold text-slate-600 dark:text-slate-300">
            <span class="rounded-2xl bg-[#4CAF50]/10 px-3 py-2 text-[#2f7d32] dark:text-[#8ee094]">{{ $recipe['ready_in_minutes'] ?? '??' }} min</span>
            <span class="rounded-2xl bg-[#FF7043]/10 px-3 py-2 text-[#b94722] dark:text-[#ffad92]">{{ $recipe['calories'] ?? '??' }} cal</span>
            <span class="rounded-2xl bg-[#FFD54F]/20 px-3 py-2 text-[#8a6b00] dark:text-[#ffe28a]">{{ $recipe['protein'] ?? '??' }}g pro</span>
        </div>
    </a>
</article>
