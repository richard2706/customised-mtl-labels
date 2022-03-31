@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full box-border border-2 border-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50']) !!}>
