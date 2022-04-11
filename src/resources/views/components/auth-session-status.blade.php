@props(['status'])

@if ($status)
    <p {{ $attributes->merge(['class' => 'my-2 p-2 text-sm text-white bg-nutrient-low']) }}>{{ $status }}</p>
@endif
