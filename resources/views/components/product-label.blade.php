@if ($labelSuccessful)
    <div class="flex flex-col gap-y-1 text-center py-2 px-3 border-2 border-gray-300">
        <div>
            <h1 class="text-xl font-bold">{{ $productName }}</h1>
            <p class="text-xs">#{{ $barcode }}</p>
        </div>

        @if ($portionSizeSpecified && $numPortions == 1)
            <p>A <span class="font-bold">{{ $displayedPortionSize }} {{ $productUnits }}</span> portion contains:</p>
        @elseif ($portionSizeSpecified)
            <p><span class="font-bold">{{ $displayedPortionSize }} {{ $productUnits }}</span> ({{ $numPortions }} {{ $singlePortionSize }} {{ $productUnits }} portions) contains:</p>
        @else
            <p><span class="font-bold">{{ $displayedPortionSize }} {{ $productUnits }}</span> contains:</p>
        @endif

        <div class="flex flex-wrap justify-center items-center gap-1">
            <div class="border border-black p-1.5 text-center flex flex-col">
                <p class="text-sm">Energy</p>
                <div class="flex flex-col">
                    @if (!is_null($nutrientValues['energy-kj']))
                        <p class="text-xs">{{ round($nutrientValues['energy-kj']) }} {{ $energyKJUnits }}</p>
                    @endif
                    @if (!is_null($nutrientValues['energy-kcal']))
                        <p class="text-sm">{{ round($nutrientValues['energy-kcal']) }} {{ $energyKcalUnits }}</p>
                        <p>
                            @if ($percentageIntakes['energy-kcal'] < 1)
                                &lt;1%
                            @else
                                {{ round($percentageIntakes['energy-kcal']) }}%
                            @endif
                        </p>
                    @else
                        <p class="text-xs">Unknown calories</p>
                    @endif
                </div>
            </div>

            <div class="border border-black p-1.5 text-center flex flex-col {{ $nutrientColourStyles['fat'] }}">
                <p class="text-sm">Fat</p>
                @if (!is_null($nutrientValues['fat']))
                    <p>{{ round($nutrientValues['fat'], 1) }} g</p>
                    <p class="mt-auto">
                        @if ($percentageIntakes['fat'] < 1)
                            &lt;1%
                        @else
                            {{ round($percentageIntakes['fat']) }}%
                        @endif
                    </p>
                @else
                    <p class="text-xs">Unknown</p>
                @endif
            </div>

            <div class="border border-black p-1.5 text-center flex flex-col {{ $nutrientColourStyles['saturated-fat'] }}">
                <p class="text-sm">Saturates</p>
                @if (!is_null($nutrientValues['saturated-fat']))
                    <p>{{ round($nutrientValues['saturated-fat'], 1) }} g</p>
                    <p class="mt-auto">
                        @if ($percentageIntakes['saturated-fat'] < 1)
                            &lt;1%
                        @else
                            {{ round($percentageIntakes['saturated-fat']) }}%
                        @endif
                    </p>
                @else
                    <p class="text-xs">Unknown</p>
                @endif
            </div>

            <div class="border border-black p-1.5 text-center flex flex-col {{ $nutrientColourStyles['sugars'] }}">
                <p class="text-sm">Sugars</p>
                @if (!is_null($nutrientValues['sugars']))
                    <p>{{ round($nutrientValues['sugars'], 1) }} g</p>
                    <p class="mt-auto">
                        @if ($percentageIntakes['sugars'] < 1)
                            &lt;1%
                        @else
                            {{ round($percentageIntakes['sugars']) }}%
                        @endif
                    </p>
                @else
                    <p class="text-xs">Unknown</p>
                @endif
            </div>

            <div class="border border-black p-1.5 text-center flex flex-col {{ $nutrientColourStyles['salt'] }}">
                <p class="text-sm">Salt</p>
                @if (!is_null($nutrientValues['salt']))
                    <p>{{ round($nutrientValues['salt'], 2) }} g</p>
                    <p class="mt-auto">
                        @if ($percentageIntakes['salt'] < 1)
                            &lt;1%
                        @else
                            {{ round($percentageIntakes['salt']) }}%
                        @endif
                    </p>
                @else
                    <p class="text-xs">Unknown</p>
                @endif
            </div>
        </div>

        @auth
            <p>of your customised intake</p>
        @else
            <p>of the reference intake</p>
        @endauth
            
        <div>
            <p class="text-sm">Energy per 100{{ $productUnits }}:
                @if (!is_null($energyKJPer100))
                    {{ $energyKJPer100 . ' ' . $energyKJUnits}}
                @endif
                @if (!is_null($energyKJPer100) && !is_null($energyKcalPer100))
                    /
                @endif
                @if (!is_null($energyKcalPer100))
                    {{ $energyKcalPer100 }} {{ $energyKcalUnits }}
                @else
                    Unknown calories
                @endif
            </p>
        </div>
    </div>
@else
    <p>Insufficient product data available.</p>
    <i>Barcode number #{{ $barcode }}</i>
@endif