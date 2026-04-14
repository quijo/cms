<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Create Giving</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('givings.store') }}">
            @csrf

            <!-- Church Name -->
           <div class="mb-4">
                <label for="church_id" class="block font-medium text-gray-700">Church</label>
                <select name="church_id" id="church_id" class="border rounded px-3 py-2 w-full" required>
                    <option value="">Select Church</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}" {{ old('church_id') == $church->id ? 'selected' : '' }}>
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
    <label for="member_id" class="block font-medium text-gray-700">Member</label>
    <select name="member_id" id="member_id" class="border rounded px-3 py-2 w-full">
        <option value="">Select Member (optional)</option>
        @foreach($members as $member)
            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>

          

        <div class="mb-4">
            <label for="type" class="block font-medium text-gray-700">Type of Giving</label>
            <select name="type" id="type" class="border rounded px-3 py-2 w-full" required>
                <option value="">Select Type</option>
                <option value="tithesAndOffering" {{ old('type') == 'tithesAndOffering' ? 'selected' : '' }}>Tithes and Offering</option>
                <option value="essentials" {{ old('type') == 'essentials' ? 'selected' : '' }}>Essentials</option>
                <option value="districtBudget" {{ old('type') == 'districtBudget' ? 'selected' : '' }}>District Budget</option>
                <option value="education" {{ old('type') == 'education' ? 'selected' : '' }}>Education</option>
                <option value="mission" {{ old('type') == 'mission' ? 'selected' : '' }}>Mission</option>
                <option value="WEF" {{ old('type') == 'WEF' ? 'selected' : '' }}>WEF</option>
                <option value="donation" {{ old('type') == 'donation' ? 'selected' : '' }}>Donation</option>
                <option value="others" {{ old('type') == 'others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>


            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block font-medium text-gray-700">Amount</label>
                <input 
                    type="number" 
                    name="amount" 
                    id="amount" 
                    value="{{ old('amount') }}" 
                    step="0.01"
                    class="border rounded px-3 py-2 w-full" 
                    required
                >
            </div>
            

            <div class="mb-4">
                <label for="or_number" class="block font-medium text-gray-700">OR Number</label>
                <input 
                    type="text" 
                    name="or_number" 
                    id="or_number" 
                    value="{{ old('or_number') }}" 
                    class="border rounded px-3 py-2 w-full" 
                    required
                >
            </div>

            <div class="mb-4">
                <label for="giving_date" class="block font-medium text-gray-700">Date of Giving</label>
                <input 
                    type="date" 
                    name="giving_date" 
                    id="giving_date" 
                    value="{{ old('giving_date', date('Y-m-d')) }}" 
                    class="border rounded px-3 py-2 w-full" 
                    required
                >
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label for="notes" class="block font-medium text-gray-700">Notes (optional)</label>
                <textarea 
                    name="notes" 
                    id="notes" 
                    rows="3" 
                    class="border rounded px-3 py-2 w-full"
                >{{ old('notes') }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('givings.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Giving
                </button>
            </div>
        </form>
    </div>
</x-app-layout>