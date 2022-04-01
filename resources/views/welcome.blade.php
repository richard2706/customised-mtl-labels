<x-guest-layout>
    <div class="flex flex-col items-center mt-2 short:pb-32">
        <p>Welcome page</p>
        <p>TODO write a welcome message and show demo/screenshots</p>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('register') }}">Create an Account</x-button-secondary>
            <x-button-primary href="{{ route('login') }}">Login</x-button-primary>
        </div>
    </x-slot>
</x-guest-layout>
