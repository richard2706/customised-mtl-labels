@props(['value'])

<label {{ $attributes->merge(['class' => 'text-md']) }}>
    {{ $value ?? $slot }}
</label>
