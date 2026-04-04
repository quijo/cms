<x-app-layout>
    <div class="flex h-screen bg-gray-100">

        <!-- Sidebar -->
        <x-sidebar class="flex-shrink-0" />

        <!-- Main content -->
        <div class="flex-1 p-6 overflow-auto">
            
            <div class="flex items-center justify-between mb-6"> 
                <h1 class="text-2xl font-bold">Users</h1>
                <a href="{{ route('users.create') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                   Add User
                </a>
            </div>

            <div class="bg-white shadow rounded p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Role</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>