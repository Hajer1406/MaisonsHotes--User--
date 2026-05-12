@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs tracking-widest uppercase text-dark-800 mb-2 ml-1']) }}>
    {{ $value ?? $slot }}
</label>
