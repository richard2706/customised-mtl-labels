<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('product.scan') }}">Scan a product</a>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <p>hello</p>
    </x-slot>
</x-app-layout>
