<x-layouts.app title="Your Recipe Dashboard">
    @php
        $userName = explode(' ', auth()->user()->name)[0] ?? auth()->user()->name;
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="glass-panel overflow-hidden p-6 sm:p-8 lg:p-10">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-[#4CAF50]">Personal dashboard</p>
                    <h1 class="mt-3 text-3xl font-black leading-tight text-slate-950 sm:text-4xl dark:text-white">Welcome back, {{ $userName }}.</h1>
                    <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base dark:text-slate-300">Your kitchen hub is ready. Review your favorites, revisit recent searches, and discover the next recipe worth saving.</p>
                </div>
                <div class="rounded-[1.5rem] border border-white/70 bg-white/70 px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-white/10 dark:text-slate-100">
                    <p class="text-slate-500 dark:text-slate-400">Today’s flow</p>
                    <p class="mt-1 text-lg font-bold text-slate-950 dark:text-white">Balanced, inspired, and effortless</p>
                </div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="dashboard-stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Saved recipes</p>
                        <span class="dashboard-badge">♥</span>
                    </div>
                    <div class="mt-4 text-3xl font-black text-slate-950 dark:text-white counter-number" data-target="{{ $favoriteCount }}">0</div>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Ready whenever you are</p>
                </div>

                <div class="dashboard-stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Recent searches</p>
                        <span class="dashboard-badge">⌕</span>
                    </div>
                    <div class="mt-4 text-3xl font-black text-slate-950 dark:text-white counter-number" data-target="{{ $historyCount }}">0</div>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Built from your last visits</p>
                </div>

                <div class="dashboard-stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Avg. prep</p>
                        <span class="dashboard-badge">⏱</span>
                    </div>
                    <div class="mt-4 text-3xl font-black text-slate-950 dark:text-white counter-number" data-target="{{ $favoriteMinutes }}">0</div>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Minutes per favorite</p>
                </div>

                <div class="dashboard-stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Avg. yield</p>
                        <span class="dashboard-badge">🍽</span>
                    </div>
                    <div class="mt-4 text-3xl font-black text-slate-950 dark:text-white counter-number" data-target="{{ $favoriteServings }}">0</div>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Servings per favorite</p>
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-6 xl:grid-cols-[1.15fr_.85fr]">
            <div class="space-y-6">
                <section class="glass-panel p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Favorite recipes</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Your collection</h2>
                        </div>
                        <a href="{{ route('recipes.index') }}" class="text-sm font-semibold text-[#4CAF50]">Browse more</a>
                    </div>

                    @if ($favorites->isNotEmpty())
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            @foreach ($favorites as $favorite)
                                <a href="{{ route('recipes.show', $favorite->spoonacular_id) }}" class="group flex gap-4 rounded-[1.5rem] border border-slate-200/70 bg-white/70 p-3 transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/10">
                                    @if ($favorite->image_url)
                                        <img src="{{ $favorite->image_url }}" alt="{{ $favorite->title }}" class="h-24 w-24 rounded-[1.2rem] object-cover">
                                    @endif
                                    <div class="min-w-0">
                                        <h3 class="line-clamp-2 font-bold text-slate-950 group-hover:text-[#4CAF50] dark:text-white">{{ $favorite->title }}</h3>
                                        <p class="mt-2 text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $favorite->ready_in_minutes ?? '??' }} min · {{ $favorite->servings ?? '??' }} servings</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-5 text-sm leading-7 text-slate-600 dark:text-slate-300">Your saved recipe collection will appear here as soon as you favorite a dish.</p>
                    @endif
                </section>

                <section class="glass-panel p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Recently searched</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Your latest ideas</h2>
                        </div>
                        <span class="rounded-full bg-[#4CAF50]/10 px-3 py-1 text-sm font-semibold text-[#2f7d32] dark:text-[#8ee094]">Live</span>
                    </div>
                    <div class="mt-6 space-y-3">
                        @forelse ($histories as $history)
                            <div class="rounded-[1.2rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-white/10">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ implode(', ', $history->ingredients) }}</p>
                                <p class="mt-2 text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $history->results_count }} results · {{ $history->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-sm leading-7 text-slate-600 dark:text-slate-300">Searches made while logged in will appear here so you can pick up where you left off.</p>
                        @endforelse
                    </div>
                </section>
            </div>

            <div class="space-y-6">
                <section class="glass-panel p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Recommended recipes</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Tailored picks</h2>
                        </div>
                        <span class="rounded-full bg-[#FFD54F]/40 px-3 py-1 text-sm font-semibold text-slate-800 dark:text-slate-200">Fresh</span>
                    </div>
                    <div class="mt-6 space-y-3">
                        @foreach ($recommendations as $recommendation)
                            <div class="rounded-[1.4rem] border border-slate-200/70 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/10">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $recommendation['title'] }}</p>
                                        <p class="mt-1 text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $recommendation['tag'] }}</p>
                                    </div>
                                    <span class="text-2xl">{{ $recommendation['accent'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="glass-panel p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Profile summary</p>
                            <h2 class="text-2xl font-black text-slate-950 dark:text-white">Quick actions</h2>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="rounded-[1.3rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-white/10">
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Signed in as</p>
                            <p class="mt-1 text-lg font-bold text-slate-900 dark:text-white">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-3">
                            <a href="{{ route('recipes.index') }}" class="rounded-full bg-[#4CAF50] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-[#4CAF50]/20 transition hover:-translate-y-0.5">Explore recipes</a>
                            <a href="{{ route('profile.edit') }}" class="rounded-full border border-slate-200 bg-white/80 px-4 py-2.5 text-sm font-semibold text-slate-800 transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/10 dark:text-white">Edit profile</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.counter-number').forEach((element) => {
            const target = Number(element.dataset.target || 0);
            const duration = 900;
            const startTime = performance.now();

            const tick = (time) => {
                const progress = Math.min((time - startTime) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const value = Math.round(target * eased);
                element.textContent = value.toString();

                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    element.textContent = target.toString();
                }
            };

            requestAnimationFrame(tick);
        });
    </script>
</x-layouts.app>
