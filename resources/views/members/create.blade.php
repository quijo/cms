<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Member') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('members.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                               required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Church -->
                    <div class="mb-4">
                        <label for="church_id" class="block text-gray-700 font-medium mb-1">Church</label>
                        <select name="church_id" id="church_id" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select Church</option>
                            @foreach($churches as $church)
                                <option value="{{ $church->id }}" {{ old('church_id') == $church->id ? 'selected' : '' }}>
                                    {{ $church->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('church_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Link to User Account (optional) -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-medium mb-1">User Account (optional)</label>
                        <select name="user_id" id="user_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">None</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-4">
                        <label for="contact_number" class="block text-gray-700 font-medium mb-1">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        @error('contact_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Age -->
                    <div class="mb-4">
                        <label for="age" class="block text-gray-700 font-medium mb-1">Age</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sex -->
                    <div class="mb-4">
                        <label for="sex" class="block text-gray-700 font-medium mb-1">Sex</label>
                        <select name="sex" id="sex"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select Sex</option>
                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Membership Date -->
                    <div class="mb-4">
                        <label for="membership_date" class="block text-gray-700 font-medium mb-1">Membership Date</label>
                        <input type="date" name="membership_date" id="membership_date" value="{{ old('membership_date') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        @error('membership_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                   <!-- Status -->
<div class="mb-4 flex items-center space-x-2">
    <input type="hidden" name="is_active" value="0">

<input 
    type="checkbox" 
    name="is_active" 
    id="is_active" 
    value="1" 
    {{ old('is_active', 1) == 1 ? 'checked' : '' }}
>

    <label for="is_active" class="text-gray-700 font-medium">Active</label>

    @error('is_active') 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Save Member
                        </button>
                        <a href="{{ route('members.index') }}"
                           class="ml-2 px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>