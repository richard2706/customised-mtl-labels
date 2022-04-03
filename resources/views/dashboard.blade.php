<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="flex flex-col items-center">
        <p>Hello, {{ Auth::user()->name }}.</p>
        <div>
            {{ $scanHistoryEntries }}
        </div>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('user.settings') }}">Your Settings</x-button-secondary>
            <x-button-primary href="{{ route('product.scan') }}">Scan Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
