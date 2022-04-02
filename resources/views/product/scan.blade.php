<x-app-layout>
    <x-slot name="title">
        Scan a Barcode
    </x-slot>

    <div class="flex flex-col items-center -mt-4 sm:mt-0 short:pb-16 gap-y-4">
        <div class="flex items-center justify-center relative -mx-2">
            <barcode-reader class="z-0"></barcode-reader>
            <div v-if="scannedBarcode != -1" class="z-10 absolute bg-white text-center py-2 px-3 shadow-lg">
                <p>@{{ scannedBarcode }}</p>
            </div>
        </div>

        <div>
            <p>If the barcode if not scanning, please try</p>
            <ul class="ml-4 list-disc">
                <li>Rotating the barcode so the lines are vertical.</li>
                <li>Holding the barcode closer to the camera.</li>
            </ul>
        </div>
        
        <form method="POST" action="{{ route('product.find') }}" id="barcode-num-form" class="w-full max-w-sm">
            @csrf
            <div class="flex flex-row justify-center space-x-2">
                <x-input type="text" name="barcode" value="" placeholder="Manually Enter Barcode" required/>
                <x-button-submit form="barcode-num-form" class="max-w-max">Done</x-button>
            </div>
        </form>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            @auth
                <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
            @else
                <x-button-secondary href="{{ route('welcome') }}">Back to Home</x-button-secondary>
            @endauth
        </div>
    </x-slot>
</x-app-layout>
