<x-app-layout>
<div class="container">
    <h2>Create Pastor</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('pastors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4">

            <!-- First Name -->
            <div>
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Last Name -->
            <div>
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Role -->
            <div>
                <label>Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="">Select Role</option>
                    @foreach(['pas','edu','admin','other'] as $role)
                        <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                            {{ strtoupper($role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label>Status</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="">Select Status</option>
                    @foreach(['licensed','ordained','deacon','local'] as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Email -->
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Phone -->
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Church -->
            <div class="col-span-2">
                <label>Church</label>
                <select name="church_id" class="w-full border p-2 rounded">
                    <option value="">Select Church</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}" {{ old('church_id') == $church->id ? 'selected' : '' }}>
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Address -->
            <div class="col-span-2">
                <label>Address</label>
                <textarea name="address" class="w-full border p-2 rounded">{{ old('address') }}</textarea>
            </div>

            <!-- Photo -->
            <div class="col-span-2">
                <label>Profile Photo</label>
                <input type="file" name="photo" class="w-full border p-2 rounded">
            </div>

        </div>

        <div class="mt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Pastor
            </button>
        </div>
    </form>
</div>
</x-app-layout>