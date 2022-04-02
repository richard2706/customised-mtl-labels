<x-app-layout>
    <x-slot name="title">
        Nutritional Guidelines
    </x-slot>

    <div class="flex flex-col justify-center items-center short:pb-32">
        @if ($barcodeIsValid)
            <x-product-label :barcode="$barcode"/>
            @guest
                <p class="text-center mt-4 max-w-lg">Log in to customise the traffic light nutrition label to your nutritional needs.</p>
            @endguest
        @else
            <p>The barcode number is invalid</p>
            <i>#{{ $barcode }}</i>
        @endif
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            @auth
                <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
            @else
                <x-button-secondary href="{{ route('welcome') }}">Back to Home</x-button-secondary>
            @endauth
            <x-button-primary href="{{ route('product.scan') }}">Scan Another Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
