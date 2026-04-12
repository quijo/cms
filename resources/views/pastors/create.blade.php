<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Add Pastor</h1>
        <a href="{{ route('pastors.index') }}" 
           class="text-sm text-gray-600 hover:underline">
            ← Back to list
        </a>
    </div>

    <!-- Error Summary -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('pastors.store') }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- First Name -->
            <div>
                <label class="block mb-1 font-medium">First Name</label>
                <input type="text" name="first_name"
                    value="{{ old('first_name') }}"
                    class="w-full border rounded p-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Last Name -->
            <div>
                <label class="block mb-1 font-medium">Last Name</label>
                <input type="text" name="last_name"
                    value="{{ old('last_name') }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- Role -->
            <div>
                <label class="block mb-1 font-medium">Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="">Select Role</option>
                    <option value="pas" {{ old('role') == 'pas' ? 'selected' : '' }}>Pastor</option>
                    <option value="edu" {{ old('role') == 'edu' ? 'selected' : '' }}>Education</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="other" {{ old('role') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="">Select Status</option>
                    <option value="licensed">Licensed</option>
                    <option value="ordained">Ordained</option>
                    <option value="deacon">Deacon</option>
                    <option value="local">Local</option>
                </select>
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-1 font-medium">Phone</label>
                <input type="text" name="phone"
                    value="{{ old('phone') }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- Church -->
            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Church</label>
                <select name="church_id" class="w-full border rounded p-2">
                    <option value="">Select Church</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}">
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Photo -->
            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Profile Photo</label>
                <input type="file" name="photo" class="w-full border rounded p-2">
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Address</label>
                <textarea name="address" rows="3"
                    class="w-full border rounded p-2">{{ old('address') }}</textarea>
            </div>

        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Pastor
            </button>
        </div>

    </form>
</div>
</x-app-layout>