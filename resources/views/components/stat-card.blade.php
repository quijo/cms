@props(['title', 'value', 'icon' => null, 'color' => 'blue'])

<div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-{{ $color }}-500">
    
    <div class="flex items-center justify-between">
        
        <div>
            <h3 class="text-sm text-gray-500">{{ $title }}</h3>
            <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
        </div>

        @if($icon)
            <div class="text-{{ $color }}-500">
                {!! $icon !!}
            </div>
        @endif

    </div>

</div>

________________________________________
