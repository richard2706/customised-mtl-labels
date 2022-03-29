<a {{ $attributes->merge(['class' => 'w-full max-w-sm box-border border-2 border-nutrient-high text-center focus:ring focus:ring-nutrient-high focus:ring-opacity-50']) }}>
    <div class="py-2 px-2 sm:hover:bg-black sm:hover:bg-opacity-10">
        {{ $slot }}
    </div>
</a>
