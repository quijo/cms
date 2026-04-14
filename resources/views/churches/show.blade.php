{{-- resources/views/churches/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Church Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">{{ $church->name }}</h3>
                    <a href="{{ route('churches.index') }}" class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">
                        Back to Churches
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="font-semibold text-gray-700">Church Number:</p>
                        <p class="text-gray-800">{{ $church->church_number }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Status:</p>
                        <p class="text-gray-800">{{ ucfirst($church->status) }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Start Date:</p>
                        <p class="text-gray-800">{{ $church->start_date->format('M d, Y') }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Contact Address:</p>
                        <p class="text-gray-800">{{ $church->contact_address }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Pastor:</p>
                        <p class="text-gray-800">{{ $church->pastor ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Members</p>
                        <p class="text-gray-800">{{ $church->membersh ?? 'N/A' }}</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('churches.edit', $church->id) }}" 
                       class="px-4 py-2 border rounded bg-gray-100 text-black hover:bg-gray-200">
                        Edit
                    </a>
                    <form action="{{ route('churches.destroy', $church->id) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this church?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 border rounded bg-gray-100 text-black hover:bg-gray-200">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>