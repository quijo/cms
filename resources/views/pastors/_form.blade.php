<form 
    action="{{ isset($pastor) ? route('pastors.update', $pastor) : route('pastors.store') }}" 
    method="POST" 
    enctype="multipart/form-data"
>
    @csrf
    @if(isset($pastor))
        @method('PUT')
    @endif

    <div class="grid grid-cols-2 gap-4">

        <!-- First Name -->
        <div>
            <label>First Name</label>
            <input type="text" name="first_name"
                value="{{ old('first_name', $pastor->first_name ?? '') }}"
                class="w-full border p-2 rounded">
            @error('first_name') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label>Last Name</label>
            <input type="text" name="last_name"
                value="{{ old('last_name', $pastor->last_name ?? '') }}"
                class="w-full border p-2 rounded">
            @error('last_name') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Role -->
        <div>
            <label>Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="">Select Role</option>
                @foreach(['pas','edu','admin','other'] as $role)
                    <option value="{{ $role }}"
                        {{ old('role', $pastor->role ?? '') == $role ? 'selected' : '' }}>
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
                    <option value="{{ $status }}"
                        {{ old('status', $pastor->status ?? '') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Email -->
        <div>
            <label>Email</label>
            <input type="email" name="email"
                value="{{ old('email', $pastor->email ?? '') }}"
                class="w-full border p-2 rounded">
        </div>

        <!-- Phone -->
        <div>
            <label>Phone</label>
            <input type="text" name="phone"
                value="{{ old('phone', $pastor->phone ?? '') }}"
                class="w-full border p-2 rounded">
        </div>

        <!-- Church -->
        <div class="col-span-2">
            <label>Church</label>
            <select name="church_id" class="w-full border p-2 rounded">
                <option value="">Select Church</option>
                @foreach($churches as $church)
                    <option value="{{ $church->id }}"
                        {{ old('church_id', $pastor->church_id ?? '') == $church->id ? 'selected' : '' }}>
                        {{ $church->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Photo -->
        <div class="col-span-2">
            <label>Profile Photo</label>
            <input type="file" name="photo" class="w-full border p-2 rounded">
        </div>

        <!-- Address -->
        <div class="col-span-2">
            <label>Address</label>
            <textarea name="address" class="w-full border p-2 rounded">
                {{ old('address', $pastor->address ?? '') }}
            </textarea>
        </div>

    </div>

    <div class="mt-4">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ isset($pastor) ? 'Update' : 'Save' }}
        </button>
    </div>
</form>