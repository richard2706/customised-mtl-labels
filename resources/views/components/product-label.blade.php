<div>
    <p>{{ $productName }}</p>
    <p>{{ $portionSize }} {{ $productUnits }} contains:</p>
    <div>
        <div>
            <p>Energy</p>
            <p>{{ $nutrientValues['energy-kj'] }} {{ $energyKJUnits }}</p>
            <p>{{ $nutrientValues['energy-kcal'] }} {{ $energyKcalUnits }}</p>
            <p></p>
        </div>
        <div>
            <p>Fat</p>
            <p>{{ $nutrientValues['fat'] }} {{ $productUnits }}</p>
        </div>
        <div>
            <p>Saturates</p>
            <p>{{ $nutrientValues['saturated-fat'] }} {{ $productUnits }}</p>
        </div>
        <div>
            <p>Sugars</p>
            <p>{{ $nutrientValues['sugars'] }} {{ $productUnits }}</p>
        </div>
        <div>
            <p>Salt</p>
            <p>{{ $nutrientValues['salt'] }} {{ $productUnits }}</p>
        </div>
    </div>
    <div>
        <p>of an adult's reference intake</p>
        <p>Energy per 100 {{ $productUnits }}: {{ $energyKJPer100 }} {{ $energyKJUnits }} / {{ $energyKcalPer100 }} {{ $energyKcalUnits }}</p>
    </div>
</div>