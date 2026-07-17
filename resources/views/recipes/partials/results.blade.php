@php
    $recipes = $recipes ?? [];
    $error = $error ?? null;
@endphp

<section class="rounded-[2rem] border border-white/70 bg-white/70 p-6 shadow-[0_24px_80px_rgba(15,23,42,0.08)] backdrop-blur-2xl dark:border-white/10 dark:bg-slate-900/60 sm:p-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#4CAF50]">Search results</p>
            <h2 class="mt-2 text-3xl font-extrabold text-slate-950 dark:text-white">{{ count($recipes) }} matches for your pantry</h2>
        </div>
        <p class="max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">Built to feel instant, calm, and deeply helpful from the first tap to the last bite.</p>
    </div>

    @if ($error)
        <div class="mt-8 rounded-[1.5rem] border border-[#FF7043]/20 bg-[#FF7043]/10 p-5 text-sm font-semibold text-[#a13d1f] dark:text-[#ffb199]">
            {{ $error }}
        </div>
    @elseif ($recipes)
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @endforeach
        </div>
    @else
        <div class="mt-8 rounded-[1.75rem] border border-dashed border-slate-300/80 bg-slate-50/70 p-10 text-center shadow-inner dark:border-white/10 dark:bg-white/10">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#4CAF50]/10 text-2xl text-[#2f7d32] dark:text-[#8ee094]">⌂</div>
            <h3 class="mt-5 text-2xl font-extrabold text-slate-950 dark:text-white">No recipes matched quite yet</h3>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">Try broadening your ingredient list or swapping one staple for a more flexible option like rice, pasta, eggs, or beans.</p>
        </div>
    @endif
</section>
