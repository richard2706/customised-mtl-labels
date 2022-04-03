<x-app-layout>
    <div class="flex justify-center short:pb-32">
        <x-user-guide></x-user-guide>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            @guest
                <x-button-secondary href="{{ route('register') }}">Create an Account</x-button-secondary>
                <x-button-secondary href="{{ route('login') }}">Log in</x-button-secondary>
            @endguest
            <x-button-primary href="{{ route('product.scan') }}">Scan a Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
