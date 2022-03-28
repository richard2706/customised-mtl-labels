<a {{ $attributes->merge(['class' => 'w-full max-w-sm box-border border-2 border-nutrient-med text-center']) }}>
    <div class="py-2 px-2 sm:hover:bg-black sm:hover:bg-opacity-10">
        {{ $slot }}
    </div>
</a>
