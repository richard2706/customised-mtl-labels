<x-app-layout>
    <x-slot name="title">
        Scan a Product
    </x-slot>

    <div class="border-2 border-black h-80 flex items-center justify-center">
        <p>Camera here</p>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
            
            <form method="POST" action="{{ route('product.find') }}" id="barcode-num-form" class="w-full max-w-lg">
                @csrf
                <div class="flex flex-row space-x-2">
                    <x-input type="text" name="barcode" value="" placeholder="Barcode number" required/>
                    <x-button-submit form="barcode-num-form" class="max-w-max">Show product label</x-button>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>
