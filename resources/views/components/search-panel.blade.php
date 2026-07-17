@props(['filters' => []])

@php($suggestions = ['chicken', 'spinach', 'rice', 'lemon', 'garlic', 'tomato', 'pasta', 'coconut', 'egg', 'beans'])
@php($chipValues = old('ingredients', isset($filters['ingredients']) ? implode(', ', $filters['ingredients']) : ''))
@php($chips = array_values(array_filter(array_map('trim', preg_split('/[,,;\n]+/', $chipValues) ?: []))))
@php($cuisines = ['Mediterranean', 'Japanese', 'Mexican', 'Italian', 'Indian', 'American', 'French', 'Thai'])
@php($diets = ['vegetarian', 'vegan', 'gluten free', 'pescatarian', 'keto', 'paleo'])
@php($prepTimes = [15 => 'Under 15 min', 30 => 'Under 30 min', 45 => 'Under 45 min', 60 => 'Under 60 min'])

<div class="mt-10 grid gap-6 lg:grid-cols-[320px_minmax(0,1fr)]" x-data="{
    loading: false,
    drawerOpen: false,
    query: '{{ addslashes($chipValues) }}',
    suggestions: @js($suggestions),
    chips: @js($chips),
    addChip(item) {
        const value = item.trim();
        if (!value || this.chips.includes(value)) return;
        this.chips.push(value);
        this.query = this.chips.join(', ');
        this.$refs.ingredients.value = this.query;
    },
    removeChip(item) {
        this.chips = this.chips.filter((chip) => chip !== item);
        this.query = this.chips.join(', ');
        this.$refs.ingredients.value = this.query;
    },
    handleInput(event) {
        this.query = event.target.value;
        const values = this.query.split(/[,;\n]+/).map((value) => value.trim()).filter(Boolean);
        this.chips = values;
    },
    async submitFilters(event) {
        event.preventDefault();
        this.loading = true;
        const form = this.$refs.filterForm;
        const params = new URLSearchParams(new FormData(form));
        params.set('ajax', '1');

        const target = document.getElementById('recipe-results');
        if (target) {
            target.innerHTML = '<div class=\'grid gap-4 sm:grid-cols-3\'>' + Array.from({ length: 3 }).map(() => '<div class=\'h-28 animate-pulse rounded-[1.5rem] border border-white/50 bg-white/60 shadow-sm dark:border-white/10 dark:bg-white/10\'></div>').join('') + '</div>';
        }

        try {
            const response = await fetch('{{ route('recipes.search') }}?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            const html = await response.text();
            if (target) {
                target.innerHTML = html;
            }
        } catch (error) {
            if (target) {
                target.innerHTML = '<div class=\'rounded-[1.5rem] border border-[#FF7043]/20 bg-[#FF7043]/10 p-5 text-sm font-semibold text-[#a13d1f] dark:text-[#ffb199]\'>Filters could not be refreshed right now. Please try again.</div>';
            }
        } finally {
            this.loading = false;
            this.drawerOpen = false;
        }
    }
}">
    <button type="button" class="mb-4 inline-flex items-center gap-2 rounded-full border border-slate-300/80 bg-white/70 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm lg:hidden dark:border-white/10 dark:bg-white/10 dark:text-slate-200" @click="drawerOpen = true">
        <span>☰</span> Filter recipes
    </button>

    <div class="fixed inset-0 z-40 bg-slate-950/35 backdrop-blur-sm lg:hidden" x-cloak x-show="drawerOpen" @click="drawerOpen = false"></div>

    <aside class="rounded-[2rem] border border-white/70 bg-white/70 p-5 shadow-[0_24px_80px_rgba(15,23,42,0.08)] backdrop-blur-2xl transition dark:border-white/10 dark:bg-slate-900/60 lg:sticky lg:top-24 lg:max-h-[calc(100vh-6rem)] lg:overflow-auto">
        <div class="flex items-center justify-between gap-3 lg:justify-start">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#4CAF50]">Refine</p>
                <h2 class="mt-1 text-2xl font-black text-slate-950 dark:text-white">Advanced filters</h2>
            </div>
            <button type="button" class="rounded-full border border-slate-200/80 bg-white/80 px-3 py-2 text-sm font-semibold text-slate-700 lg:hidden dark:border-white/10 dark:bg-white/10 dark:text-slate-200" @click="drawerOpen = false">Close</button>
        </div>

        <form x-ref="filterForm" action="{{ route('recipes.search') }}" method="GET" class="mt-6 space-y-4" @submit="submitFilters($event)">
            <input type="hidden" name="ajax" value="1">
            <label class="block">
                <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Ingredients</span>
                <div class="rounded-[1.25rem] border border-slate-200/70 bg-white/80 p-3 shadow-sm dark:border-white/10 dark:bg-slate-900/60">
                    <textarea x-ref="ingredients" name="ingredients" rows="3" placeholder="Chicken, spinach, lemon" class="min-h-24 w-full resize-none rounded-[1rem] border border-transparent bg-transparent px-3 py-2 text-sm text-slate-950 outline-none placeholder:text-slate-400 focus:border-[#4CAF50] dark:text-white" @input="handleInput($event)">{{ $chipValues }}</textarea>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <template x-for="chip in chips" :key="chip">
                            <span class="inline-flex items-center gap-2 rounded-full border border-[#4CAF50]/20 bg-[#4CAF50]/10 px-3 py-1.5 text-sm font-semibold text-[#2f7d32] dark:border-[#4CAF50]/25 dark:bg-[#4CAF50]/15 dark:text-[#8ee094]">
                                <span x-text="chip"></span>
                                <button type="button" class="text-xs" @click="removeChip(chip)">×</button>
                            </span>
                        </template>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <template x-for="suggestion in suggestions" :key="suggestion">
                            <button type="button" class="rounded-full border border-slate-200/80 bg-white/70 px-3 py-1.5 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-[#4CAF50]/30 hover:text-[#2f7d32] dark:border-white/10 dark:bg-white/10 dark:text-slate-200" @click="addChip(suggestion)">
                                <span x-text="suggestion"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </label>

            <label class="block">
                <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Cuisine</span>
                <select name="cuisine" class="form-select h-12 rounded-[1.15rem]">
                    <option value="">Any cuisine</option>
                    @foreach ($cuisines as $cuisine)
                        <option value="{{ $cuisine }}" @selected(old('cuisine', $filters['cuisine'] ?? '') === $cuisine)>{{ $cuisine }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Diet</span>
                <select name="diet" class="form-select h-12 rounded-[1.15rem]">
                    <option value="">Any diet</option>
                    @foreach ($diets as $diet)
                        <option value="{{ $diet }}" @selected(old('diet', $filters['diet'] ?? '') === $diet)>{{ str($diet)->title() }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Meal type</span>
                <select name="meal_type" class="form-select h-12 rounded-[1.15rem]">
                    <option value="">Any meal type</option>
                    <option value="main course" @selected(old('meal_type', $filters['meal_type'] ?? '') === 'main course')>Main course</option>
                    <option value="dessert" @selected(old('meal_type', $filters['meal_type'] ?? '') === 'dessert')>Dessert</option>
                    <option value="salad" @selected(old('meal_type', $filters['meal_type'] ?? '') === 'salad')>Salad</option>
                    <option value="soup" @selected(old('meal_type', $filters['meal_type'] ?? '') === 'soup')>Soup</option>
                </select>
            </label>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Calories</span>
                    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-1">
                        <input type="number" name="min_calories" min="0" max="5000" value="{{ old('min_calories', $filters['min_calories'] ?? '') }}" placeholder="Min" class="form-select h-12 rounded-[1.15rem] px-4 text-sm" />
                        <input type="number" name="max_calories" min="0" max="5000" value="{{ old('max_calories', $filters['max_calories'] ?? '') }}" placeholder="Max" class="form-select h-12 rounded-[1.15rem] px-4 text-sm" />
                    </div>
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Preparation time</span>
                    <select name="max_ready_time" class="form-select h-12 rounded-[1.15rem]">
                        <option value="">Any time</option>
                        @foreach ($prepTimes as $minutes => $label)
                            <option value="{{ $minutes }}" @selected((string) old('max_ready_time', $filters['max_ready_time'] ?? '') === (string) $minutes)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <label class="block">
                <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Sorting</span>
                <select name="sort" class="form-select h-12 rounded-[1.15rem]">
                    <option value="max-used-ingredients" @selected(old('sort', $filters['sort'] ?? '') === 'max-used-ingredients')>Best pantry match</option>
                    <option value="time" @selected(old('sort', $filters['sort'] ?? '') === 'time')>Fastest</option>
                    <option value="calories" @selected(old('sort', $filters['sort'] ?? '') === 'calories')>Lowest calories</option>
                    <option value="random" @selected(old('sort', $filters['sort'] ?? '') === 'random')>Surprise me</option>
                </select>
            </label>

            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#4CAF50] px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-[#4CAF50]/25 transition hover:-translate-y-0.5">
                <span x-show="!loading">Apply filters</span>
                <span x-cloak x-show="loading" class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"/></svg>
                    Updating…
                </span>
            </button>
        </form>
    </aside>
</div>
