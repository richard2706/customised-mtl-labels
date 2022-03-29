@props(['errors'])

@if ($errors->any())
    <div class="flex flex-col items-center py-1">
        <ul class="not-first:mt-2 space-y-2 list-none text-sm text-white">
            @foreach ($errors->all() as $error)
                <li class="p-2 bg-nutrient-high">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
