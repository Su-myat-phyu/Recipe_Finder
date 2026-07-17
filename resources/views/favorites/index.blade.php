<x-layouts.app title="Your favorites">
    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="glass-panel overflow-hidden p-6 sm:p-8 lg:p-10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-[#4CAF50]">Favorites</p>
                    <h1 class="mt-3 text-3xl font-black leading-tight text-slate-950 sm:text-4xl dark:text-white">Your saved recipe collection</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">Every recipe you saved is here, ready for a quick revisit or a new night of cooking.</p>
                </div>
                <a href="{{ route('recipes.index') }}" class="inline-flex items-center gap-2 rounded-full bg-[#4CAF50] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-[#4CAF50]/20 transition hover:-translate-y-0.5">Discover more recipes</a>
            </div>

            @if ($favorites->isNotEmpty())
                <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($favorites as $favorite)
                        <article class="group overflow-hidden rounded-[1.75rem] border border-slate-200/70 bg-white/75 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/10">
                            <a href="{{ route('recipes.show', $favorite->spoonacular_id) }}" class="block">
                                @if ($favorite->image_url)
                                    <img src="{{ $favorite->image_url }}" alt="{{ $favorite->title }}" class="h-44 w-full object-cover">
                                @endif
                                <div class="p-5">
                                    <h2 class="text-lg font-black text-slate-950 dark:text-white">{{ $favorite->title }}</h2>
                                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $favorite->ready_in_minutes ?? '??' }} min · {{ $favorite->servings ?? '??' }} servings</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-8 rounded-[1.75rem] border border-dashed border-slate-300/80 bg-slate-50/70 p-10 text-center shadow-inner dark:border-white/10 dark:bg-white/10">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#4CAF50]/10 text-2xl text-[#2f7d32] dark:text-[#8ee094]">♡</div>
                    <h2 class="mt-5 text-2xl font-extrabold text-slate-950 dark:text-white">Nothing saved yet</h2>
                    <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">Tap the heart on any recipe card or detail page to build a personal collection of dishes you want to make again.</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
