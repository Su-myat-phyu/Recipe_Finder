@props(['label', 'name'])

<label class="block">
    <span class="mb-2 block text-sm font-semibold text-slate-700 dark:text-white/82">{{ $label }}</span>
    <input name="{{ $name }}" {{ $attributes->merge(['class' => 'auth-input']) }}>
    @error($name)
        <span class="validation-pop mt-2 block text-sm font-semibold text-[#FFD54F]">{{ $message }}</span>
    @enderror
</label>
