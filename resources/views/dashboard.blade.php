<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="flex flex-col items-center short:pb-32">
        <p>Hello, {{ Auth::user()->name }}.</p>

        @if ($scanHistoryEntries->count() > 0)
            <h1 class="text-lg text-center font-bold mt-4">Previously Scanned Products</h1>

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

                    <div class="flex items-center gap-x-2">
                        <div class="flex items-center gap-x-2 border-2 border-gray-300 w-full p-2">
                            <div>
                                <h2 class="font-bold">{{ $entry->product_name }}</h2>
                                <i class="text-xs">#{{ $entry->barcode }}</i>
                            </div>
                            <div class="w-24 ml-auto text-right">
                                <p class="text-sm">{{ $entry->hour }}:{{ $entry->minute }}:{{ $entry->second }}</p>
                            </div>
                        </div>
                        <x-button-secondary width="xs:min-w-max" class="ml-auto" href="{{ route('product.show', ['barcode' => $entry->barcode]) }}">View Nutrition Label</x-button-secondary>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <x-slot name="footer">
        <div class="flex flex-col items-center space-y-2 p-2">
            <x-button-secondary href="{{ route('user.settings') }}">Your Settings</x-button-secondary>
            <x-button-primary href="{{ route('product.scan') }}">Scan Barcode</x-button-primary>
        </div>
    </x-slot>
</x-app-layout>
