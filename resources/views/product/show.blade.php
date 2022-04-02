<x-app-layout>
    <x-slot name="title">
        Nutritional Guidelines
    </x-slot>

    <div class="flex flex-col justify-center items-center gap-y-4 short:pb-32">
        @if ($barcodeIsValid)
            <x-product-label :barcode="$barcode" :numPortions="$numPortions"/>

            @guest
                <p class="text-center max-w-lg">Log in to customise the traffic light nutrition label to your nutritional needs.</p>
            @endguest

            <form method="POST" action="{{ route('product.find') }}" id="num-portions-form" class="w-full max-w-sm">
                @csrf
                <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                <div class="flex flex-row justify-center space-x-2">
                    <x-input class="w-24" type="number" min="1" name="numPortions" value="{{ $numPortions }}" placeholder="Number of Portions" required/>
                    <x-button-submit form="num-portions-form" class="max-w-max">Update Label</x-button>
                </div>
            </form>
        @else
            <p>The barcode number is invalid</p>
            <i>#{{ $barcode }}</i>
        @endif
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            @auth
                <x-button-secondary href="{{ route('user.settings') }}">Customise Your Labels</x-button-secondary>
                <x-button-secondary href="{{ route('dashboard') }}">Back to Home</x-button-secondary>
            @else
                <x-button-secondary href="{{ route('welcome') }}">Back to Home</x-button-secondary>
            @endauth
            <x-button-primary href="{{ route('product.scan') }}">Scan Another Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
