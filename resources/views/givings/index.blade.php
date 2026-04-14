<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Givings</h2>
            <a href="{{ route('givings.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Giving</a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('givings.index') }}" class="mb-4 flex gap-2">
            <input 
                type="text" 
                name="church_name" 
                value="{{ request('church_name') }}" 
                placeholder="Search by Church Name"
                class="border rounded px-3 py-2 w-full"
            />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
            @if(request('church_name'))
                <a href="{{ route('givings.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Clear</a>
            @endif
        </form>

        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Church</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Notes</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($givings as $giving)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $giving->id }}</td>
                        <td class="px-4 py-2">
                            {{ $giving->church->name ?? 'N/A' }}
                        </td>
                       
                        <td class="px-4 py-2">{{ number_format($giving->amount, 2) }}</td>
                        <td class="px-4 py-2" >{{ $giving->type }}</td>
                        <td class="px-4 py-2">{{ $giving->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-2">{{ $giving->notes ?? '-' }}</td>

                        <td class="border px-4 py-2 flex gap-2">
                            <!-- Show (Eye) -->
                            <a href="{{ route('givings.show', $giving->id) }}"
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
                            <a href="{{ route('givings.edit', $giving->id) }}"
                               class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-6-6l6 6m0 0L13 11m6 6l-6-6" />
                                </svg>
                            </a>

                            <!-- Delete (Bin) -->
                            <form action="{{ route('givings.destroy', $giving->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this giving?');">
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
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">No givings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $givings->links() }}
        </div>
    </div>
</x-app-layout>