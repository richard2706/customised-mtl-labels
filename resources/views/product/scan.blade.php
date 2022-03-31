<x-app-layout>
    <x-slot name="title">
        Scan a Product
    </x-slot>

    <div class="flex flex-col items-center">
        <div class="border-2 border-black h-80 w-full flex items-center justify-center">
            <p>Camera here</p>
            <barcode-reader></barcode-reader>
        </div>

        <form method="POST" action="{{ route('product.find') }}" id="barcode-num-form" class="w-full max-w-sm mt-4">
            @csrf
            <div class="flex flex-row justify-center space-x-2">
                <x-input type="text" name="barcode" value="" placeholder="Manually Enter Barcode" required/>
                <x-button-submit form="barcode-num-form" class="max-w-max">Done</x-button>
            </div>
        </form>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
        </div>
    </x-slot>
</x-app-layout>
