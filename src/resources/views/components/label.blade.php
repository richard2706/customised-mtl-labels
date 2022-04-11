@props(['value'])

<label {{ $attributes->merge(['class' => 'text-lg']) }}>
    {{ $value ?? $slot }}
</label>
