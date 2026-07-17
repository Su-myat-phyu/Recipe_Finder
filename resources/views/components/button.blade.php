@props(['variant' => 'primary'])

@php
    $classes = [
        'primary' => 'bg-[#4CAF50] text-white shadow-lg shadow-[#4CAF50]/25 hover:bg-[#43a047]',
        'secondary' => 'bg-[#FF7043] text-white shadow-lg shadow-[#FF7043]/25 hover:bg-[#f06236]',
        'ghost' => 'border border-slate-200 bg-white/70 text-slate-800 hover:border-[#4CAF50]/50 hover:text-[#4CAF50] dark:border-white/10 dark:bg-white/10 dark:text-white',
    ][$variant];
@endphp

<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-bold transition duration-300 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-[#4CAF50]/20 $classes"]) }}>
    {{ $slot }}
</button>
