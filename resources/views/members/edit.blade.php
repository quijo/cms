<x-app-layout>
    <x-slot name="title">Edit Member</x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-semibold mb-6">Edit Member</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="name">Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $member->name) }}"
                       class="border rounded px-3 py-2 w-full" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $member->email) }}"
                       class="border rounded px-3 py-2 w-full" required>
            </div>

            {{-- Church --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="church_id">Church</label>
                <select name="church_id" id="church_id" class="border rounded px-3 py-2 w-full">
                    <option value="">-- Select Church --</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}"
                            {{ old('church_id', $member->church_id) == $church->id ? 'selected' : '' }}>
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="mb-4 flex items-center space-x-2">
                <input type="checkbox" name="is_active" id="is_active"
                    {{ old('is_active', $member->is_active) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <label for="is_active" class="text-gray-700 font-medium">Active</label>
            </div>

            {{-- Buttons --}}
            <div class="flex space-x-3 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Member
                </button>
                <a href="{{ route('members.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</x-app-layout>