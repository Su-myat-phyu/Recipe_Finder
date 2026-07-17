<x-layouts.app title="Recipe Finder">
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
        <div class="relative overflow-hidden rounded-[2.5rem] border border-white/70 bg-white/70 p-6 shadow-[0_35px_120px_rgba(15,23,42,0.12)] backdrop-blur-2xl dark:border-white/10 dark:bg-slate-900/70 sm:p-8 lg:p-12">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(76,175,80,0.18),transparent_28%),radial-gradient(circle_at_85%_20%,rgba(255,112,67,0.2),transparent_30%),linear-gradient(135deg,rgba(255,255,255,0.9),rgba(248,250,252,0.7))] dark:bg-[radial-gradient(circle_at_top_left,rgba(76,175,80,0.2),transparent_30%),radial-gradient(circle_at_85%_20%,rgba(255,112,67,0.2),transparent_32%),linear-gradient(135deg,rgba(15,23,42,0.96),rgba(24,35,52,0.94))]"></div>
            <div class="absolute -left-10 top-3 h-40 w-40 rounded-full bg-[#4CAF50]/20 blur-3xl animate-blob-float"></div>
            <div class="absolute right-0 top-10 h-56 w-56 rounded-full bg-[#FF7043]/20 blur-3xl animate-blob-float animation-delay-200"></div>
            <div class="relative grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="animate-reveal">
                    <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-400/30 bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-700 backdrop-blur dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-200">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                        Pantry-first discovery, curated like a luxury app
                    </div>
                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.02] tracking-tight text-slate-950 dark:text-white sm:text-5xl lg:text-6xl">
                        Turn every ingredient into a bold, beautiful dinner.
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 dark:text-slate-300 sm:text-lg">
                        Discover recipes that feel effortless, elegant, and built around what you already have at home.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-100">
                            Start cooking
                        </a>
                        <a href="#trending" class="inline-flex items-center justify-center rounded-full border border-slate-300/80 bg-white/70 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:bg-white dark:border-white/10 dark:bg-white/10 dark:text-slate-100">
                            Explore recipes
                        </a>
                    </div>
                    <div class="mt-8 flex flex-wrap gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <span class="rounded-full border border-slate-300/70 bg-white/60 px-3 py-1.5 dark:border-white/10 dark:bg-white/10">Smart pantry matching</span>
                        <span class="rounded-full border border-slate-300/70 bg-white/60 px-3 py-1.5 dark:border-white/10 dark:bg-white/10">Cuisines for every mood</span>
                        <span class="rounded-full border border-slate-300/70 bg-white/60 px-3 py-1.5 dark:border-white/10 dark:bg-white/10">Save favorites effortlessly</span>
                    </div>
                </div>

                <div class="animate-reveal animation-delay-200">
                    <div class="relative mx-auto max-w-xl">
                        <div class="absolute -right-5 -top-5 h-20 w-20 rounded-full border border-[#4CAF50]/30 bg-[#4CAF50]/15 blur-2xl"></div>
                        <div class="glass-panel relative overflow-hidden p-5 sm:p-6">
                            <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-r from-[#4CAF50]/18 via-transparent to-[#FF7043]/18"></div>
                            <div class="relative">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500 dark:text-slate-400">Tonight’s pick</p>
                                        <h2 class="mt-2 text-2xl font-extrabold text-slate-950 dark:text-white">Crispy harissa chickpea bowls</h2>
                                    </div>
                                    <div class="rounded-full border border-[#4CAF50]/30 bg-[#4CAF50]/10 px-3 py-1 text-sm font-semibold text-[#2f7d32] dark:text-[#8ee094]">93% match</div>
                                </div>
                                <div class="mt-6 rounded-[1.5rem] border border-white/50 bg-gradient-to-br from-white/70 to-white/40 p-4 shadow-inner shadow-white/70 dark:border-white/10 dark:from-white/10 dark:to-white/5">
                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 shadow-sm dark:border-white/10 dark:bg-slate-900/60">
                                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Ingredients</p>
                                            <p class="mt-2 text-sm leading-7 text-slate-700 dark:text-slate-300">Chickpeas, yogurt, lemon, herbs, toasted pita</p>
                                        </div>
                                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 shadow-sm dark:border-white/10 dark:bg-slate-900/60">
                                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Ready in</p>
                                            <p class="mt-2 text-sm leading-7 text-slate-700 dark:text-slate-300">18 minutes • 2 servings • Vegan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex items-center justify-between rounded-[1.25rem] border border-slate-200/70 bg-white/70 px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm dark:border-white/10 dark:bg-slate-900/50 dark:text-slate-200">
                                    <span>Saved in your pantry vault</span>
                                    <span class="rounded-full bg-[#FFD54F]/20 px-3 py-1 text-[#8a6b00] dark:text-[#ffe28a]">Trending now</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-10 rounded-[1.5rem] border border-[#FF7043]/20 bg-[#FF7043]/10 px-5 py-4 text-sm font-semibold text-[#a13d1f] shadow-sm dark:text-[#ffb199]">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-10 flex flex-col gap-6 lg:flex-row">
            <x-search-panel :filters="$filters ?? []" />

            <div class="flex-1">
                <div id="recipe-results">
                    @if ($searched)
                        @include('recipes.partials.results', ['recipes' => $recipes, 'filters' => $filters, 'searched' => true, 'error' => null])
                    @else
                        <section class="rounded-[2rem] border border-white/70 bg-white/70 p-6 shadow-[0_24px_80px_rgba(15,23,42,0.08)] backdrop-blur-2xl dark:border-white/10 dark:bg-slate-900/60 sm:p-8">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#4CAF50]">Discover recipes</p>
                                    <h2 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Filter your way to the perfect meal</h2>
                                </div>
                                <p class="max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">Choose your pantry ingredients, cuisine, meal style, and timing to surface the recipes that make the most sense tonight.</p>
                            </div>
                            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                                @php($starterRecipes = [
                                    ['title' => 'Harissa chickpea bowls', 'meta' => '18 min • Vegan • Pantry ready'],
                                    ['title' => 'Lemon herb salmon', 'meta' => '25 min • Quick dinner • High protein'],
                                    ['title' => 'Creamy tomato pasta', 'meta' => '20 min • Cozy • Weeknight favorite'],
                                ])
                                @foreach ($starterRecipes as $recipe)
                                    <div class="rounded-[1.5rem] border border-slate-200/70 bg-slate-50/70 p-5 shadow-sm dark:border-white/10 dark:bg-white/10">
                                        <h3 class="text-lg font-extrabold text-slate-950 dark:text-white">{{ $recipe['title'] }}</h3>
                                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $recipe['meta'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>

        <section id="trending" class="mt-14">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#4CAF50]">Trending recipes</p>
                    <h2 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Fresh ideas for the week ahead</h2>
                </div>
                <p class="max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">Visual, fast, and built around pantry staples, these picks feel as good as they taste.</p>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-3">
                @php($trending = [
                    ['title' => 'Smoky tomato pasta', 'meta' => '15 min • Comfort food • 4 stars', 'accent' => 'from-[#4CAF50]/18 to-transparent'],
                    ['title' => 'Golden coconut curry', 'meta' => '22 min • Cozy • 5 stars', 'accent' => 'from-[#FF7043]/18 to-transparent'],
                    ['title' => 'Lemon herb gnocchi', 'meta' => '20 min • Bright • 4.8 stars', 'accent' => 'from-[#FFD54F]/24 to-transparent'],
                ])
                @foreach ($trending as $recipe)
                    <article class="group animate-reveal glass-panel overflow-hidden p-5 transition hover:-translate-y-1 hover:shadow-[0_24px_80px_rgba(15,23,42,0.16)]">
                        <div class="h-36 rounded-[1.5rem] border border-white/50 bg-gradient-to-br {{ $recipe['accent'] }} p-4 dark:border-white/10">
                            <div class="flex h-full flex-col justify-between rounded-[1.25rem] border border-white/60 bg-white/70 p-4 shadow-sm backdrop-blur dark:border-white/10 dark:bg-slate-900/50">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500 dark:text-slate-400">Featured</p>
                                    <h3 class="mt-2 text-xl font-extrabold text-slate-950 dark:text-white">{{ $recipe['title'] }}</h3>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-300">{{ $recipe['meta'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">Pantry ready</span>
                            <button class="rounded-full border border-slate-200/80 px-3 py-1.5 text-sm font-semibold text-slate-700 transition group-hover:border-[#4CAF50]/30 group-hover:text-[#2f7d32] dark:border-white/10 dark:text-slate-200">Preview</button>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="mt-14 rounded-[2rem] border border-white/60 bg-white/60 p-6 shadow-[0_24px_80px_rgba(15,23,42,0.08)] backdrop-blur-xl dark:border-white/10 dark:bg-slate-900/60 sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#FF7043]">Popular cuisines</p>
                    <h2 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Travel the globe without leaving the kitchen</h2>
                </div>
                <p class="max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">From Mediterranean comfort to bold street-food flavors, explore a world of weeknight possibilities.</p>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                @foreach (['Mediterranean', 'Japanese', 'Mexican', 'Italian', 'Indian', 'Middle Eastern'] as $cuisine)
                    <span class="rounded-full border border-slate-300/70 bg-white/70 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-[#4CAF50]/30 hover:text-[#2f7d32] dark:border-white/10 dark:bg-white/10 dark:text-slate-200">{{ $cuisine }}</span>
                @endforeach
            </div>
        </section>

        <section class="mt-14 grid gap-5 lg:grid-cols-3">
            @php($features = [
                ['title' => 'Ingredient-first search', 'copy' => 'Enter what you already have and discover recipes matched for flavor, practicality, and timing.', 'icon' => '✦'],
                ['title' => 'Beautifully organized favorites', 'copy' => 'Save your best meals, revisit them instantly, and build a personal recipe vault.', 'icon' => '♡'],
                ['title' => 'Made for recurring routines', 'copy' => 'Track your weekly staples and turn repeatable meals into a calm, low-friction ritual.', 'icon' => '⚡'],
            ])
            @foreach ($features as $feature)
                <div class="animate-reveal glass-panel p-6 transition hover:-translate-y-1">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-[#4CAF50]/20 to-[#FF7043]/20 text-xl text-slate-900 dark:text-white">{{ $feature['icon'] }}</div>
                    <h3 class="mt-5 text-xl font-extrabold text-slate-950 dark:text-white">{{ $feature['title'] }}</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $feature['copy'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="mt-14 grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="glass-panel p-6 sm:p-8">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#4CAF50]">Testimonials</p>
                <h2 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">Loved by home cooks who want less stress and more flavor</h2>
                <div class="mt-8 space-y-4">
                    <blockquote class="rounded-[1.5rem] border border-slate-200/70 bg-white/70 p-5 text-sm leading-7 text-slate-700 shadow-sm dark:border-white/10 dark:bg-slate-900/50 dark:text-slate-300">
                        “It feels like having a private chef guide me through the fridge. The flow is effortless.”
                        <footer class="mt-3 font-semibold text-slate-950 dark:text-white">Mina • Brooklyn</footer>
                    </blockquote>
                    <blockquote class="rounded-[1.5rem] border border-slate-200/70 bg-white/70 p-5 text-sm leading-7 text-slate-700 shadow-sm dark:border-white/10 dark:bg-slate-900/50 dark:text-slate-300">
                        “The experience is polished, calm, and genuinely inspiring. I now cook with confidence.”
                        <footer class="mt-3 font-semibold text-slate-950 dark:text-white">Jordan • Seattle</footer>
                    </blockquote>
                </div>
            </div>

            <div class="grid gap-5">
                <div class="glass-panel p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#FF7043]">Statistics</p>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-slate-900/50">
                            <div class="text-3xl font-extrabold text-slate-950 dark:text-white">12k+</div>
                            <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">recipes discovered</div>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-slate-900/50">
                            <div class="text-3xl font-extrabold text-slate-950 dark:text-white">94%</div>
                            <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">ingredient match rate</div>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-slate-900/50">
                            <div class="text-3xl font-extrabold text-slate-950 dark:text-white">4.9/5</div>
                            <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">average cook satisfaction</div>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/70 p-4 dark:border-white/10 dark:bg-slate-900/50">
                            <div class="text-3xl font-extrabold text-slate-950 dark:text-white">1.8m</div>
                            <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">meals saved weekly</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="mt-14 rounded-[2rem] border border-white/60 bg-slate-950 px-6 py-8 text-white shadow-[0_24px_80px_rgba(15,23,42,0.12)] dark:border-white/10 sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-lg font-extrabold">Recipe Finder</p>
                    <p class="mt-2 max-w-xl text-sm leading-7 text-slate-300">A premium kitchen companion for turning pantry staples into memorable meals.</p>
                </div>
                <div class="flex flex-wrap gap-3 text-sm text-slate-300">
                    <a href="{{ route('register') }}" class="transition hover:text-white">Create account</a>
                    <a href="{{ route('login') }}" class="transition hover:text-white">Log in</a>
                </div>
            </div>
        </footer>
    </section>
</x-layouts.app>
