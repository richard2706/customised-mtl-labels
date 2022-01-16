<div>
    <p>{{ $productName }}</p>
    <p>{{ $portionSize }} {{ $productUnits }} contains:</p>
    <div>
        <div>
            <p>Energy</p>
            @if (!is_null($nutrientValues['energy-kj']))
                <p>{{ $nutrientValues['energy-kj'] }} {{ $energyKJUnits }}</p>
            @endif
            @if (!is_null($nutrientValues['energy-kcal']))
                <p>{{ $nutrientValues['energy-kcal'] }} {{ $energyKcalUnits }}</p>
            @else
                <p>Unknown calories</p>
            @endif
            <p></p>
        </div>
        <div>
            <p>Fat</p>
            @if (!is_null($nutrientValues['fat']))
                <p>{{ $nutrientValues['fat'] }} {{ $productUnits }}</p>
            @else
                <p>Unknown</p>
            @endif
        </div>
        <div>
            <p>Saturates</p>
            @if (!is_null($nutrientValues['saturated-fat']))
                <p>{{ $nutrientValues['saturated-fat'] }} {{ $productUnits }}</p>
            @else
                <p>Unknown</p>
            @endif
        </div>
        <div>
            <p>Sugars</p>
            @if (!is_null($nutrientValues['sugars']))
                <p>{{ $nutrientValues['sugars'] }} {{ $productUnits }}</p>
            @else
                <p>Unknown</p>
            @endif
        </div>
        <div>
            <p>Salt</p>
            @if (!is_null($nutrientValues['salt']))
                <p>{{ $nutrientValues['salt'] }} {{ $productUnits }}</p>
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