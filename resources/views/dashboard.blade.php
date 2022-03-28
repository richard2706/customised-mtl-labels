<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="flex flex-col items-center">
        <p>Hello, {{ Auth::user()->name }}.</p>
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <a href="{{ route('user.settings') }}" class="w-full max-w-sm box-border border-2 border-nutrient-med text-center">
                <div class="py-2 px-2 sm:hover:bg-black sm:hover:bg-opacity-10">
                    Your Settings
                </div>
            </a>
            <a href="{{ route('product.scan') }}" class="w-full max-w-sm box-border bg-nutrient-high text-center text-white">
                <div class="py-2 px-2 sm:hover:bg-black sm:hover:bg-opacity-25">
                    Scan Barcode
                </div>
            </a>
        </div>
    </x-slot>
</x-app-layout>
