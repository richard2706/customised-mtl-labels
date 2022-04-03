@props(['color' => 'nutrient-high', 'textcolor' => 'white'])

<a {{ $attributes->merge(['class' => 'w-full max-w-sm box-border text-' . $textcolor . ' bg-' . $color . ' text-center focus:ring focus:ring-' . $color . ' focus:ring-opacity-50']) }}>
    <div class="py-2.5 px-3 w-full h-full sm:hover:bg-black sm:hover:bg-opacity-25">
        {{ $slot }}
    </div>
</a>
