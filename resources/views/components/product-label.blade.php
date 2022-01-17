<div class="inline-block text-center">
    <b class="text-lg">{{ $productName }}</b>
    <p class="text-xs">{{ $barcode }}</p>

    <div class="my-2">
        <p>{{ $portionSize }} {{ $productUnits }} contains:</p>

        <div class="inline-flex space-x-0.5">

            <div class="border border-black rounded p-1 text-center flex flex-col">
                <p class="text-sm">Energy</p>
                <div class="flex flex-col">
                    @if (!is_null($nutrientValues['energy-kj']))
                        <p>{{ round($nutrientValues['energy-kj']) }} {{ $energyKJUnits }}</p>
                    @endif
                    @if (!is_null($nutrientValues['energy-kcal']))
                        <p>{{ round($nutrientValues['energy-kcal']) }} {{ $energyKcalUnits }}</p>
                    @else
                        <p class="text-xs">Unknown calories</p>
                    @endif
                </div>
                <p class="mt-auto">
                    @if ($percentageIntakes['energy-kcal'] < 1)
                        &lt;1%
                    @else
                        {{ round($percentageIntakes['energy-kcal']) }}%
                    @endif
                </p>
            </div>

            <div class="border border-black rounded p-1 text-center flex flex-col bg-{{ $nutrientColours['fat'] }}">
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

            <div class="border border-black rounded p-1 text-center flex flex-col bg-{{ $nutrientColours['saturated-fat'] }}">
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

            <div class="border border-black rounded p-1 text-center flex flex-col bg-{{ $nutrientColours['sugars'] }}">
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

            <div class="border border-black rounded p-1 text-center flex flex-col bg-{{ $nutrientColours['salt'] }}">
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

        <p>of your customised intake</p>
    </div>
        
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