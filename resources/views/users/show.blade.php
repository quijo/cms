<x-app-layout>
    <x-slot name="title">User Details</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">User Details</h2>
            <a href="{{ route('users.index') }}"
               class="px-4 py-2 bg-gray-200 text-black rounded hover:bg-gray-300">
                Back to Users
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-semibold">Name</h3>
                <p>{{ $user->name }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Email</h3>
                <p>{{ $user->email }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Church / Membership</h3>
                <p>{{ $user->church->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Role(s)</h3>
                <p>{{ $user->roles->pluck('name')->join(', ') }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Created At</h3>
                <p>{{ $user->created_at->format('F j, Y, g:i A') }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Updated At</h3>
                <p>{{ $user->updated_at->format('F j, Y, g:i A') }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            @can('edit users')
            <a href="{{ route('users.edit', $user->id) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Edit User
            </a>
            @endcan

            @can('delete users')
            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete User
                </button>
            </form>
            @endcan
        </div>

    </div>
</x-app-layout>