@props(['disabled' => false, 'color' => 'nutrient-med'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full px-2.5 py-1.5 box-border border-4 border-' . $color . ' focus:border-' . $color . ' focus:ring focus:ring-' . $color . ' focus:ring-opacity-50']) !!}>
