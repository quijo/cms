<x-app-layout>
    <x-slot name="title">Member Details</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-2xl font-semibold mb-4">Member Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <strong>Name:</strong> {{ $member->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $member->email ?? 'N/A' }}
            </div>
            <div>
                <strong>Church:</strong> {{ $member->church->name ?? 'N/A' }}
            </div>
            <div>
                <strong>Status:</strong>
                @if($member->is_active)
                    <span class="px-2 py-1 rounded-full bg-green-100 text-green-800">Active</span>
                @else
                    <span class="px-2 py-1 rounded-full bg-red-100 text-red-800">Inactive</span>
                @endif
            </div>
            <div class="col-span-2 mt-4">
                <a href="{{ route('members.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mr-3">
                    Back to Members
                </a>
                <a href="{{ route('members.edit', $member->id) }}" 
                   class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    Edit Member
                </a>
            </div>
        </div>
    </div>
</x-app-layout>