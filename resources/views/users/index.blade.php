<x-app-layout>
    <x-slot name="title">Users</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow">

        @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif
        <!-- Header with Add User -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Users List</h2>

            @can('create users')
            <a href="{{ route('users.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Add User
            </a>
            @endcan
        </div>

        <!-- Search & Filter -->
        <form method="GET" class="flex flex-wrap gap-4 mb-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name, email, or church"
                   class="border rounded px-3 py-2 flex-1">

            <select name="role" class="border rounded px-3 py-2">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filter
            </button>
        </form>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Church / Membership</th>
                        <th class="border px-4 py-2">Role(s)</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->church->name ?? $user->membership ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <!-- Show (Eye) -->
                            <a href="{{ route('users.show', $user->id) }}"
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
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="p-2 border rounded bg-gray-100 text-black hover:bg-gray-200"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-6-6l6 6m0 0L13 11m6 6l-6-6" />
                                </svg>
                            </a>

                            <!-- Delete (Bin) -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                        <td colspan="6" class="border px-4 py-2 text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>