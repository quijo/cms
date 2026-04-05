@props([
    'placeholder' => 'Search...'
])

<form method="GET" class="flex flex-wrap gap-4 mb-4 items-center">

    {{-- Search Input with Lens Icon --}}
    <div class="relative flex-1 min-w-[200px]">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
            🔍
        </span>

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="{{ $placeholder }}"
               class="border rounded pl-10 pr-3 py-2 w-full">
    </div>

    {{-- Dynamic filters from the parent page --}}
    {{ $slot }}

    {{-- Buttons --}}
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>

    <a href="{{ url()->current() }}"
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Reset
    </a>

</form>