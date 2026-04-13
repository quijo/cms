

<x-app-layout>

<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Pastors</h1>

    <a href="{{ route('pastors.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded">
        Add Pastor
    </a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Church</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pastors as $pastor)
            <tr class="border-t">
                <td class="p-2">{{ $pastor->full_name }}</td>
                <td>{{ $pastor->role }}</td>
                <td>{{ $pastor->status }}</td>
                <td>{{ $pastor->church->name ?? '-' }}</td>
                 <td class="border px-4 py-2 flex gap-2">
                            <!-- Show (Eye) -->
                            <a href="{{ route('pastors.show', $pastor->id) }}"
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
                            <a href="{{ route('pastors.edit', $pastor->id) }}"
                               class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-6-6l6 6m0 0L13 11m6 6l-6-6" />
                                </svg>
                            </a>

                            <!-- Delete (Bin) -->
                            <form action="{{ route('pastors.destroy', $pastor->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this giving?');">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                onclick="deleteMember({{ $pastor->id }})"
                                class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                                title="Delete"
                                id="delete-btn">     
                                
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
        </tbody>
    </table>
</div>

</x-app-layout>
