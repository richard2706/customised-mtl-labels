<x-app-layout>
    <x-slot name="title">
        Scan a Product
    </x-slot>

    <div class="flex flex-col items-center -mx-2 pb-16">
        <div class="flex flex-col items-center justify-center -mt-4 w-full gap-y-2">
            <div>
                <barcode-reader></barcode-reader>
            </div>
            <div class="flex flex-col items-center gap-y-2 mx-2">
                <p class="text-center">Please hold the barcode closer to the camera if the barcode is not being scanned.</p>
                <form method="POST" action="{{ route('product.find') }}" id="barcode-num-form" class="w-full max-w-sm">
                    @csrf
                    <div class="flex flex-row justify-center space-x-2">
                        <x-input type="text" name="barcode" value="" placeholder="Manually Enter Barcode" required/>
                        <x-button-submit form="barcode-num-form" class="max-w-max">Done</x-button>
                    </div>
                </form>
            </div>
            <p>Scanned Barcode: @{{ scannedBarcode }}</p>
        </div>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
        </div>
    </x-slot>
</x-app-layout>
