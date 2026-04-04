<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- Back button -->
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">
                    &larr; Back to Users
                </a>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Name -->
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text"
                                   value="{{ old('name', $user->name) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email"
                                   value="{{ old('email', $user->email) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Church -->
                        <div>
                            <label for="church" class="block font-medium text-gray-700">Church / Membership</label>
                            <input id="church" name="church" type="text"
                                   value="{{ old('church', $user->church) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block font-medium text-gray-700">Role</label>
                            <select name="role" id="role"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role', $user->roles->first()?->id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block font-medium text-gray-700">
                                Password (leave blank to keep current)
                            </label>
                            <input id="password" name="password" type="password"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>