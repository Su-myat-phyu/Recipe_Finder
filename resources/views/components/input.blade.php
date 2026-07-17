@props(['label', 'name'])

<label class="block">
    <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $label }}</span>
    <input name="{{ $name }}" {{ $attributes->merge(['class' => 'w-full rounded-2xl border border-white/50 bg-white/70 px-4 py-3 text-sm text-slate-950 shadow-inner outline-none transition placeholder:text-slate-400 focus:border-[#4CAF50] focus:ring-4 focus:ring-[#4CAF50]/15 dark:border-white/10 dark:bg-white/10 dark:text-white']) }}>
    @error($name)
        <span class="mt-2 block text-sm font-semibold text-[#FF7043]">{{ $message }}</span>
    @enderror
</label>
