<x-app-layout>
    <x-slot name="title">
        User Guide
    </x-slot>

    <div class="flex justify-center pb-16">
        <x-user-guide></x-user-guide>
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