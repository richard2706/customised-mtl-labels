<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="flex flex-col items-center gap-y-4 short:pb-32">
        <p>Hello, {{ Auth::user()->name }}.</p>

        @if ($scanHistoryEntries->count() > 0)
            <x-button-secondary href="{{ route('userguide') }}">See User Guide</x-button-secondary>

            <div>
                <h1 class="text-lg text-center font-bold">Previously Scanned Products</h1>
    
                <div class="flex flex-col gap-y-2 mt-1 w-fit max-w-xl">
                    @foreach ($scanHistoryEntries as $i => $entry)
                        @if ($i == 0 || !($entry->year == $scanHistoryEntries[$i - 1]->year
                                && $entry->month == $scanHistoryEntries[$i - 1]->month
                                && $entry->day == $scanHistoryEntries[$i - 1]->day))
                            <div class="@if ($i > 0) mt-3 @endif">
                                @if ($entry->created_at->isToday())
                                    <p>Today</p>
                                @elseif ($entry->created_at->isYesterday())
                                    <p>Yesterday</p>
                                @else
                                    <p>@if ($entry->created_at->isCurrentWeek() || $entry->created_at->isLastWeek()) {{ $entry->created_at->englishDayOfWeek }} @endif {{ $entry->day }}/{{ $entry->month }}/{{ $entry->year }}</p>
                                @endif
                            </div>
                        @endif
    
                        <div class="flex flex-col xs:flex-row xs:items-center gap-y-1 gap-x-3 border-2 border-gray-300 w-full p-2">
                            <p class="text-sm">{{ $entry->hour }}:{{ $entry->minute }}</p>
                            <div>
                                <h2 class="font-bold">{{ $entry->product_name }}</h2>
                                <i class="text-xs">#{{ $entry->barcode }}</i>
                            </div>
                            <x-button-secondary class="xs:max-w-max mt-1 xs:mt-0 ml-auto" href="{{ route('product.show', ['barcode' => $entry->barcode]) }}">View Label</x-button-secondary>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <x-user-guide></x-user-guide>
        @endif
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('user.settings') }}">Your Settings</x-button-secondary>
            <x-button-primary href="{{ route('product.scan') }}">Scan Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
