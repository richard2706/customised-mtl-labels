<x-guest-layout>
    <div class="flex flex-col text-center items-center gap-y-4 mx-auto max-w-xl short:pb-32">
        <p>Scan any product's barcode then you will be shown its traffic light nutrition label. This provides a visual representation of the nutritional value of one portion of the product.</p>
        <p>If you log in, then you can customise for each nutrient, when the traffic light label shows it as green, amber or red.</p>
        <p>You can also customise your daily maximum for each nutrient, then the percentages will reflect the amount each nutrient (in one portion of the product) contributes to your daily maximum.</p>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('product.scan') }}">Scan a Barcode</x-button-secondary>
            <x-button-secondary href="{{ route('register') }}">Create an Account</x-button-secondary>
            <x-button-primary href="{{ route('login') }}">Login</x-button-primary>
        </div>
    </x-slot>
</x-guest-layout>
