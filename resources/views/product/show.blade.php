<x-app-layout>
    <x-slot name="title">
        Nutritional Guidelines
    </x-slot>

    <div class="flex flex-col justify-center items-center gap-y-4 @auth short:pb-48 @else short:pb-32 @endauth">
        @if ($productFound)
            <x-product-label :barcode="$barcode" :numPortions="$numPortions"/>

            @guest
                <p class="text-center max-w-lg">Log in to customise the traffic light nutrition label to your nutritional needs.</p>
            @endguest

            @if ($portionSizeSpecified)
                <form method="POST" action="{{ route('product.find') }}" id="num-portions-form" class="max-w-xs">
                    @csrf
                    <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                    <x-label>Number of Portions:</x-label>
                    <div class="flex flex-row justify-center items-center space-x-2 mt-1">
                        <x-input type="number" min="1" name="numPortions" value="{{ $numPortions }}" placeholder="Number of Portions" required/>
                        <x-button-submit form="num-portions-form" class="max-w-max">Update Label</x-button>
                    </div>
                </form>
            @endif
        @else
            <p>The product could not be identified.</p>
            <i>Barcode number: #{{ $barcode }}</i>
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
