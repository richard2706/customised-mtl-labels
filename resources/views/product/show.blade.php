<x-app-layout>
    <x-slot name="title">
        {{ $productName }}
    </x-slot>

    <div class="flex flex-col justify-center items-center pb-32">
        @if ($barcodeIsValid)
            <x-product-label :barcode="$barcode"/>
        @else
            <p>The barcode number is invalid</p>
            <i>{{ $barcode }}</i>
        @endif
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
            <x-button-secondary href="{{ route('product.scan') }}">Scan Another Barcode</x-button-secondary>
        </div>
    </x-slot>
</x-app-layout>
