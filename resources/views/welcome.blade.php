<x-guest-layout>
    <div class="flex flex-col items-center">
        <p>Welcome page</p>
        <p>TODO write a welcome message and show demo/screenshots</p>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center p-2">
            <x-button-primary href="{{ route('login') }}">Login</x-button-primary>
        </div>
    </x-slot>
</x-guest-layout>
