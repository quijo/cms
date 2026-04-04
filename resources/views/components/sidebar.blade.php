<div x-data="{ openDropdown: null }" class="flex flex-col h-full bg-white border-r border-gray-200 w-64">

    <!-- Logo -->
    <div class="h-16 flex items-center justify-center font-bold border-b">
        MyDashboard
    </div>

    <!-- Links -->
    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
        @php $currentRoute = request()->route()->getName(); @endphp



        
        @foreach($links as $link)
            @if(isset($link['children']))
                <!-- Dropdown -->
                <div>
                    <button @click="openDropdown === '{{ $link['name'] }}' ? openDropdown = null : openDropdown = '{{ $link['name'] }}'"
                            class="w-full flex justify-between items-center px-2 py-2 text-left rounded hover:bg-gray-200
                            {{ collect($link['children'])->pluck('route')->contains($currentRoute) ? 'bg-gray-200 font-semibold' : '' }}">
                        <span>{{ $link['name'] }}</span>
                        <svg :class="{'rotate-180': openDropdown === '{{ $link['name'] }}'}" class="w-4 h-4 transition-transform"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="openDropdown === '{{ $link['name'] }}'" x-transition class="ml-4 mt-1 space-y-1">
                        @foreach($link['children'] as $child)
                            <a href="{{ route($child['route']) }}" 
                               class="block px-2 py-1 rounded hover:bg-gray-200
                               {{ $currentRoute === $child['route'] ? 'bg-gray-300 font-semibold' : '' }}">
                               {{ $child['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Single Link -->
                <a href="{{ route($link['route']) }}"
                   class="block px-2 py-2 rounded hover:bg-gray-200
                   {{ $currentRoute === $link['route'] ? 'bg-gray-200 font-semibold' : '' }}">
                   {{ $link['name'] }}
                </a>
            @endif
        @endforeach
    </nav>
</div>