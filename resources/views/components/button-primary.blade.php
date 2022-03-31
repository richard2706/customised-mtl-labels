<a {{ $attributes->merge(['class' => 'w-full max-w-sm box-border bg-nutrient-high text-center text-white focus:ring focus:ring-nutrient-high focus:ring-opacity-50']) }}>
    <div class="py-2 px-3 sm:hover:bg-black sm:hover:bg-opacity-25">
        {{ $slot }}
    </div>
</a>
