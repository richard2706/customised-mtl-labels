@props(['width' => 'w-full', 'color' => 'nutrient-high', 'textcolor' => 'black'])

<a {{ $attributes->merge(['class' => $width . ' max-w-sm box-border text-' . $textcolor . ' border-2 border-' . $color . ' text-center focus:ring focus:ring-' . $color . ' focus:ring-opacity-50']) }}>
    <div class="py-2 px-3 w-full h-full sm:hover:bg-black sm:hover:bg-opacity-10">
        {{ $slot }}
    </div>
</a>
