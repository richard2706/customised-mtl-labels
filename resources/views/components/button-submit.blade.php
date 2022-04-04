@props(['color' => 'nutrient-high', 'textcolor' => 'white'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full max-w-sm box-border text-' . $textcolor . ' bg-' . $color . ' text-center focus:ring focus:ring-' . $color . ' focus:ring-opacity-50']) }}>
    <div class="py-2.5 px-4 w-full h-full sm:hover:bg-black sm:hover:bg-opacity-25">
        {{ $slot }}
    </div>
</button>
