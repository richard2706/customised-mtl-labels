<a {{ $attributes->merge(['class' => 'w-full max-w-sm box-border bg-nutrient-high text-center text-white']) }}>
    <div class="py-2 px-2 sm:hover:bg-black sm:hover:bg-opacity-25">
        {{ $slot }}
    </div>
</a>
