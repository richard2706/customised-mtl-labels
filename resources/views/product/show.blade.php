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
                <div class="flex flex-col gap-y-2">
                    <p>Choose a portion size:</p>
                    <div class="flex flex-wrap gap-2">
                        @if ($numPortions != 0.5)
                            <form method="POST" action="{{ route('product.find') }}" id="half-portion-form" class="max-w-xs">
                                @csrf
                                <input type="number" step=".05" name="numPortions" value="0.5" hidden required/>
                                <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                                <x-button-submit-secondary form="half-portion-form" class="max-w-max">1/2 portion</x-button-submit-secondary>
                            </form>
                        @endif

                        @if ($numPortions != 0.75)
                            <form method="POST" action="{{ route('product.find') }}" id="three-quarter-portion-form" class="max-w-xs">
                                @csrf
                                <input type="number" step=".05" name="numPortions" value="0.75" hidden required/>
                                <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                                <x-button-submit-secondary form="three-quarter-portion-form" class="max-w-max">3/4 portion</x-button-submit-secondary>
                            </form>
                        @endif

                        @if ($numPortions != 1)
                            <form method="POST" action="{{ route('product.find') }}" id="one-portion-form" class="max-w-xs">
                                @csrf
                                <input type="number" step=".05" name="numPortions" value="1" hidden required/>
                                <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                                <x-button-submit-secondary form="one-portion-form" class="max-w-max">1 portion</x-button-submit-secondary>
                            </form>
                        @endif

                        @if ($numPortions != 2)
                            <form method="POST" action="{{ route('product.find') }}" id="two-portions-form" class="max-w-xs">
                                @csrf
                                <input type="number" step=".05" name="numPortions" value="2" hidden required/>
                                <input type="text" name="barcode" value="{{ $barcode }}" hidden>
                                <x-button-submit-secondary form="two-portions-form" class="max-w-max">2 portions</x-button-submit-secondary>
                            </form>
                        @endif
                    </div>

                    <p>Or enter the number of portions:</p>
                    <form method="POST" action="{{ route('product.find') }}" id="num-portions-form" class="max-w-xs">
                        @csrf
                        <input type="text" name="barcode" value="{{ $barcode }}" hidden required>
                        <div class="flex justify-center items-center space-x-2">
                            <x-input type="number" step=".05" min="0.05" name="numPortions" value="{{ $numPortions }}" placeholder="Number of Portions" required/>
                            <x-button-submit form="num-portions-form" class="max-w-max">Update Label</x-button-submit>
                        </div>
                    </form>
                </div>
            @else
                <p>Unable to determine portion size. The label is for 100 g/ml.</p>
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
