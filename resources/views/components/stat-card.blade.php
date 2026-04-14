{{-- @props(['title', 'value', 'icon', 'color', 'model', 'route']) --}}

@if($route)
<a href="{{ route($route) }}" class="block">
@endif

<div class="flex flex-col items-center justify-center bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition-shadow cursor-pointer">
    <!-- Icon -->
    @if($icon)
        <div class="text-{{ $color }}-500 mb-4">
            {!! $icon !!}
        </div>
    @endif

    <!-- Title -->
    <h3 class="text-sm text-gray-500 dark:text-gray-300 mb-2">{{ $title }}</h3>

    <!-- Value -->
    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $value}}</p>
</div>

@if($route)
</a>
@endif
