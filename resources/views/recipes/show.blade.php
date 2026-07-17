<x-layouts.app :title="$recipe['title']">
    @php
        $instructions = $recipe['instructions'] ?? [];
        $ingredients = $recipe['ingredients'] ?? [];
        $nutrition = $recipe['nutrition'] ?? [];
        $prepTime = (int) ($recipe['ready_in_minutes'] ?? 30);
        $servings = (int) ($recipe['servings'] ?? 2);
        $difficulty = $prepTime >= 45 ? 'Intermediate' : ($prepTime >= 25 ? 'Medium' : 'Easy');
        $timelineMinutes = max(4, (int) ceil($prepTime / max(1, count($instructions))));
        $summaryText = strip_tags($recipe['summary'] ?? '');
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        @if (session('status'))
            <div class="mb-6 rounded-[1.5rem] border border-[#4CAF50]/20 bg-[#4CAF50]/10 px-5 py-4 text-sm font-semibold text-[#2f7d32] dark:text-[#8ee094]">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-[2.5rem] border border-white/70 bg-white/70 shadow-[0_35px_120px_rgba(15,23,42,0.14)] backdrop-blur-2xl dark:border-white/10 dark:bg-white/10">
            <div class="grid lg:grid-cols-[1.05fr_0.95fr]">
                <div class="relative order-2 p-6 sm:p-8 lg:order-1 lg:p-10">
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('recipes.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white/70 px-3.5 py-2 text-sm font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:text-slate-100">
                            <span class="text-base">←</span> Back to recipes
                        </a>
                        <span class="rounded-full border border-[#4CAF50]/20 bg-[#4CAF50]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#2f7d32] dark:text-[#8ee094]">Chef’s pick</span>
                    </div>

                    <div class="mt-7 flex flex-wrap gap-2">
                        @foreach (array_slice(array_merge($recipe['dish_types'], $recipe['diets']), 0, 5) as $tag)
                            <span class="rounded-full bg-slate-900/5 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-white/10 dark:text-slate-200">{{ str($tag)->title() }}</span>
                        @endforeach
                    </div>

                    <h1 class="mt-6 text-3xl font-black leading-tight text-slate-950 sm:text-4xl lg:text-5xl dark:text-white">{{ $recipe['title'] }}</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-base">{{ $summaryText }}</p>

                    <div class="mt-7 flex flex-wrap gap-3">
                        @auth
                            <button type="button"
                                class="favorite-toggle inline-flex items-center gap-2 rounded-full px-5 py-3 text-sm font-semibold shadow-lg transition hover:-translate-y-0.5 {{ $isFavorite ? 'border border-slate-200 bg-white/80 text-slate-800 dark:border-white/10 dark:bg-white/10 dark:text-white' : 'bg-[#4CAF50] text-white shadow-[#4CAF50]/25' }}"
                                data-recipe-id="{{ $recipe['id'] }}"
                                data-favorited="{{ $isFavorite ? '1' : '0' }}"
                                data-title="{{ $recipe['title'] }}"
                                data-image-url="{{ $recipe['image'] }}"
                                data-ready-in-minutes="{{ $recipe['ready_in_minutes'] ?? '' }}"
                                data-servings="{{ $recipe['servings'] ?? '' }}"
                                data-source-url="{{ $recipe['source_url'] ?? '' }}"
                                data-summary="{{ $recipe['summary'] ?? '' }}">
                                <span class="favorite-icon text-lg {{ $isFavorite ? 'text-[#FF5A5F]' : 'text-white' }}">{{ $isFavorite ? '♥' : '♡' }}</span>
                                <span class="favorite-label">{{ $isFavorite ? 'Saved' : 'Favorite' }}</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full bg-[#4CAF50] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-[#4CAF50]/25 transition hover:-translate-y-0.5">
                                <span>♡</span> Login to save
                            </a>
                        @endauth

                        <button id="share-recipe" type="button" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/80 px-5 py-3 text-sm font-semibold text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:text-white">
                            <span>↗</span> Share
                        </button>

                        @if ($recipe['source_url'])
                            <a href="{{ $recipe['source_url'] }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/80 px-5 py-3 text-sm font-semibold text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:text-white">
                                <span>⧉</span> Source
                            </a>
                        @endif
                    </div>

                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <div class="stat-tile animate-reveal">
                            <span>{{ $prepTime }} min</span>
                            <small>Cooking time</small>
                        </div>
                        <div class="stat-tile animate-reveal animation-delay-150">
                            <span>{{ $difficulty }}</span>
                            <small>Difficulty</small>
                        </div>
                        <div class="stat-tile animate-reveal animation-delay-200">
                            <span>{{ $servings }} serves</span>
                            <small>Servings</small>
                        </div>
                    </div>
                </div>

                <div class="relative order-1 min-h-[280px] overflow-hidden lg:order-2 lg:min-h-full">
                    @if ($recipe['image'])
                        <img src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}" class="h-full w-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8">
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-2 text-sm font-semibold text-white backdrop-blur-xl">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#4CAF50]"></span>
                            Ready in {{ $prepTime }} minutes
                        </div>
                        <div class="mt-4 max-w-md rounded-[1.75rem] border border-white/20 bg-white/10 p-4 text-sm text-white/90 shadow-2xl backdrop-blur-xl">
                            <p class="font-semibold">A polished, weeknight-friendly recipe with balanced flavor and simple steps.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky top-4 z-20 mt-6 flex flex-wrap gap-3 rounded-full border border-white/70 bg-white/70 p-2 shadow-lg shadow-slate-200/60 backdrop-blur-2xl dark:border-white/10 dark:bg-white/10 dark:shadow-black/20">
            <a href="#overview" class="recipe-nav-pill">Overview</a>
            <a href="#ingredients" class="recipe-nav-pill">Ingredients</a>
            <a href="#nutrition" class="recipe-nav-pill">Nutrition</a>
            <a href="#method" class="recipe-nav-pill">Method</a>
        </div>

        <div class="mt-8 grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
            <div class="space-y-6">
                <section id="overview" class="glass-panel animate-reveal p-6 sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#4CAF50]/10 text-lg font-extrabold text-[#2f7d32] dark:text-[#8ee094]">✦</span>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Recipe snapshot</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Why this dish stands out</h2>
                        </div>
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[1.5rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Build</p>
                            <p class="mt-2 text-lg font-bold text-slate-900 dark:text-white">Simple, balanced, and crowd-friendly</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Best for</p>
                            <p class="mt-2 text-lg font-bold text-slate-900 dark:text-white">Weeknight dinners and meal prep</p>
                        </div>
                    </div>
                </section>

                <section id="ingredients" class="glass-panel animate-reveal p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Checklist</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Ingredients</h2>
                        </div>
                        <span class="rounded-full bg-[#4CAF50]/10 px-3 py-1 text-sm font-semibold text-[#2f7d32] dark:text-[#8ee094]">{{ count($ingredients) }} items</span>
                    </div>
                    @if ($ingredients)
                        <ul class="mt-6 space-y-3">
                            @foreach ($ingredients as $ingredient)
                                <li class="ingredient-item flex items-start gap-3 rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 text-sm leading-6 text-slate-700 shadow-sm dark:border-white/10 dark:bg-white/10 dark:text-slate-200">
                                    <span class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-[#4CAF50]"></span>
                                    <span>{{ $ingredient }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-slate-300">No ingredient details were returned for this recipe.</p>
                    @endif
                </section>

                <section id="method" class="glass-panel animate-reveal p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Flow</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Cooking timeline</h2>
                        </div>
                        <span class="rounded-full bg-[#FFD54F]/40 px-3 py-1 text-sm font-semibold text-slate-800 dark:text-slate-200">{{ count($instructions) }} steps</span>
                    </div>
                    @if ($instructions)
                        <ol class="mt-6 space-y-4">
                            @foreach ($instructions as $step)
                                <li class="timeline-card rounded-[1.5rem] border border-slate-200/70 bg-white/70 p-5 shadow-sm dark:border-white/10 dark:bg-white/10">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#FFD54F] text-sm font-black text-slate-950">{{ $step['number'] ?? $loop->iteration }}</span>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Step {{ $step['number'] ?? $loop->iteration }}</p>
                                                <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $step['step'] }}</p>
                                            </div>
                                        </div>
                                        <span class="rounded-full bg-slate-900/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-700 dark:bg-white/10 dark:text-slate-200">≈ {{ $timelineMinutes }} min</span>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-slate-300">Detailed instructions were not returned for this recipe. Open the original source for the full walkthrough.</p>
                    @endif
                </section>
            </div>

            <div class="space-y-6">
                <section id="nutrition" class="glass-panel animate-reveal p-6 sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#FF7043]/10 text-lg font-extrabold text-[#c35b2b]">⚖</span>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Fuel</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Nutrition</h2>
                        </div>
                    </div>
                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach ($nutrition as $label => $amount)
                            <div class="nutrition-card rounded-[1.5rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-white/10">
                                <p class="text-lg font-black text-slate-900 dark:text-white">{{ $amount ?? '—' }}{{ $label === 'calories' ? '' : 'g' }}</p>
                                <p class="mt-1 text-sm font-semibold capitalize text-slate-500 dark:text-slate-400">{{ str($label)->replace('_', ' ')->title() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="glass-panel animate-reveal p-6 sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-[#FFD54F]/50 text-lg font-extrabold text-slate-800">⏱</span>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">At a glance</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Everything you need</h2>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Prep</p>
                            <p class="mt-2 text-lg font-bold text-slate-900 dark:text-white">{{ $prepTime }} minutes</p>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Difficulty</p>
                            <p class="mt-2 text-lg font-bold text-slate-900 dark:text-white">{{ $difficulty }}</p>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Yield</p>
                            <p class="mt-2 text-lg font-bold text-slate-900 dark:text-white">{{ $servings }} servings</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('share-recipe')?.addEventListener('click', async () => {
            const shareData = {
                title: document.title,
                text: 'Check out this recipe from Recipe Finder',
                url: window.location.href,
            };

            if (navigator.share) {
                await navigator.share(shareData);
                return;
            }

            try {
                await navigator.clipboard.writeText(window.location.href);
                const button = document.getElementById('share-recipe');
                if (button) {
                    const original = button.innerHTML;
                    button.innerHTML = '<span>✓</span> Link copied';
                    window.setTimeout(() => {
                        button.innerHTML = original;
                    }, 1600);
                }
            } catch (error) {
                console.error(error);
            }
        });

        document.querySelectorAll('.favorite-toggle').forEach((button) => {
            button.addEventListener('click', async () => {
                const isFavorited = button.dataset.favorited === '1';
                const recipeId = button.dataset.recipeId;
                const payload = {
                    spoonacular_id: recipeId,
                    title: button.dataset.title || '',
                    image_url: button.dataset.imageUrl || '',
                    ready_in_minutes: button.dataset.readyInMinutes || null,
                    servings: button.dataset.servings || null,
                    source_url: button.dataset.sourceUrl || '',
                    summary: button.dataset.summary || '',
                    meta: {},
                };

                button.disabled = true;
                const icon = button.querySelector('.favorite-icon');
                const label = button.querySelector('.favorite-label');
                if (icon) {
                    icon.classList.add('animate-[heart-pop_0.3s_ease-out]');
                }

                try {
                    const response = await fetch(isFavorited ? `/favorites/${recipeId}` : '/favorites', {
                        method: isFavorited ? 'DELETE' : 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: isFavorited ? null : JSON.stringify(payload),
                    });

                    const data = await response.json();
                    if (data.favorited) {
                        button.dataset.favorited = '1';
                        button.classList.remove('bg-[#4CAF50]', 'text-white', 'shadow-[#4CAF50]/25');
                        button.classList.add('border', 'border-slate-200', 'bg-white/80', 'text-slate-800', 'dark:border-white/10', 'dark:bg-white/10', 'dark:text-white');
                        if (icon) {
                            icon.textContent = '♥';
                            icon.classList.remove('text-white');
                            icon.classList.add('text-[#FF5A5F]');
                        }
                        if (label) {
                            label.textContent = 'Saved';
                        }
                    } else {
                        button.dataset.favorited = '0';
                        button.classList.remove('border', 'border-slate-200', 'bg-white/80', 'text-slate-800', 'dark:border-white/10', 'dark:bg-white/10', 'dark:text-white');
                        button.classList.add('bg-[#4CAF50]', 'text-white', 'shadow-[#4CAF50]/25');
                        if (icon) {
                            icon.textContent = '♡';
                            icon.classList.remove('text-[#FF5A5F]');
                            icon.classList.add('text-white');
                        }
                        if (label) {
                            label.textContent = 'Favorite';
                        }
                    }
                } catch (error) {
                    console.error(error);
                } finally {
                    button.disabled = false;
                    if (icon) {
                        icon.classList.remove('animate-[heart-pop_0.3s_ease-out]');
                    }
                }
            });
        });
    </script>
</x-layouts.app>
