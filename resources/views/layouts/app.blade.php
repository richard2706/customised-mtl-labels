<!-- app layout extends the guest layout by adding a log out button. Other slots may be filled when this layout is used. -->
<x-guest-layout>
    <x-slot name="header">{{ $header ?? '' }}</x-slot>

    <x-slot name="navigation">
        <div class="ml-auto content-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="text-gray-800 border-2 border-gray-800 py-1 px-2 sm:hover:bg-black sm:hover:bg-opacity-10">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </x-slot>

    <x-slot name="slot">{{ $slot ?? '' }}</x-slot>

    <x-slot name="footer">{{ $footer ?? '' }}</x-slot>
</x-guest-layout>
