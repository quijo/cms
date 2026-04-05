<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Churches
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">All Churches</h3>
                    <a href="{{ route('churches.create') }}" class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">Add Church</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                   <x-filter-bar placeholder="Search churches...">
<form method="GET" action="{{ route('churches.index') }}" class="flex gap-2 mb-4 flex-wrap">
        
       

    

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Search</button>
        <a href="{{ route('churches.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Reset</a>
    </form>
</x-filter-bar>
                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Church Number</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Start Date</th>
                            <th class="px-4 py-2 border">Contact Address</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($churches as $church)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $church->name }}</td>
                                <td class="px-4 py-2 border">{{ $church->church_number }}</td>
                                <td class="px-4 py-2 border">{{ ucfirst($church->status) }}</td>
                                <td class="px-4 py-2 border">{{ $church->start_date->format('M d, Y') }}</td>
                                <td class="px-4 py-2 border">{{ $church->contact_address }}</td>
                                <td class="px-4 py-2 flex space-x-2">

    <td class="border px-4 py-2 flex gap-2">
                            <!-- Show (Eye) -->
                            <a href="{{ route('churches.show', $church->id) }}"
                               class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                               title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <!-- Edit (Pencil) -->
                            <a href="{{ route('churches.edit', $church->id) }}"
                               class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-6-6l6 6m0 0L13 11m6 6l-6-6" />
                                </svg>
                            </a>

                            <!-- Delete (Bin) -->
                            <form action="{{ route('churches.destroy', $church->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this church?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                                        title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a2 2 0 012 2v1H8V5a2 2 0 012-2z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                            </tr>
                        @endforeach
                        @if($churches->isEmpty())
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">No churches found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>