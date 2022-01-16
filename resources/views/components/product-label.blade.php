<div>
    <p>{{ $productName }}</p>
    <p>{{ $portionSize }} {{ $productUnits }} contains:</p>
    <div>
        <div>
            <p>Energy</p>
            @if (!is_null($nutrientValues['energy-kj']))
                <p>{{ round($nutrientValues['energy-kj']) }} {{ $energyKJUnits }}</p>
            @endif
            @if (!is_null($nutrientValues['energy-kcal']))
                <p>{{ round($nutrientValues['energy-kcal']) }} {{ $energyKcalUnits }}</p>
            @else
                <p>Unknown calories</p>
            @endif
            @if ($percentageIntakes['energy-kcal'] < 1)
                <p>&lt;1%</p>
            @else
                <p>{{ round($percentageIntakes['energy-kcal']) }}%</p>
            @endif
        </div>

        <div>
            <p>Fat</p>
            @if (!is_null($nutrientValues['fat']))
                <p>{{ round($nutrientValues['fat'], 1) }} g</p>
                @if ($percentageIntakes['fat'] < 1)
                    <p>&lt;1%</p>
                @else
                    <p>{{ round($percentageIntakes['fat']) }}%</p>
                @endif
            @else
                <p>Unknown</p>
            @endif
        </div>

        <div>
            <p>Saturates</p>
            @if (!is_null($nutrientValues['saturated-fat']))
                <p>{{ round($nutrientValues['saturated-fat'], 1) }} g</p>
                @if ($percentageIntakes['saturated-fat'] < 1)
                    <p>&lt;1%</p>
                @else
                    <p>{{ round($percentageIntakes['saturated-fat']) }}%</p>
                @endif
            @else
                <p>Unknown</p>
            @endif
        </div>

        <div>
            <p>Sugars</p>
            @if (!is_null($nutrientValues['sugars']))
                <p>{{ round($nutrientValues['sugars'], 1) }} g</p>
                @if ($percentageIntakes['sugars'] < 1)
                    <p>&lt;1%</p>
                @else
                    <p>{{ round($percentageIntakes['sugars']) }}%</p>
                @endif
            @else
                <p>Unknown</p>
            @endif
        </div>

        <div>
            <p>Salt</p>
            @if (!is_null($nutrientValues['salt']))
                <p>{{ round($nutrientValues['salt'], 2) }} g</p>
                @if ($percentageIntakes['salt'] < 1)
                    <p>&lt;1%</p>
                @else
                    <p>{{ round($percentageIntakes['salt']) }}%</p>
                @endif
            @else
                <p>Unknown</p>
            @endif
        </div>
    </div>

    <div>
        <p>of an adult's reference intake</p>
        <p>Energy per 100{{ $productUnits }}:
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