<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Scan a Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any)
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('product.find') }}">
                        @csrf

                        <x-label for="name">Barcode number</x-label>
                        <x-input type="text" name="barcode" value=""/>
                        <br>

                        <x-button class="mt-2">Show product label</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
