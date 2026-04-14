<x-app-layout>
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">

    <h2 class="text-2xl font-bold mb-6">Edit Giving</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('givings.update', $giving->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Church -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Church</label>
            <select name="church_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Church</option>
                @foreach($churches as $church)
                    <option value="{{ $church->id }}"
                        {{ $giving->church_id == $church->id ? 'selected' : '' }}>
                        {{ $church->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Member ID -->
        {{-- <div class="mb-4">
            <label class="block font-medium mb-1">Member ID (optional)</label>
            <input type="number" name="member_id"
                   value="{{ old('member_id', $giving->member_id) }}"
                   class="w-full border rounded px-3 py-2">
        </div> --}}

        <!-- OR Number -->
        <div class="mb-4">
            <label class="block font-medium mb-1">OR Number</label>
            <input type="text" name="or_number"
                   value="{{ old('or_number', $giving->or_number) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Giving Date -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Giving Date</label>
            <input type="date" name="giving_date"
                   value="{{ old('giving_date', $giving->giving_date) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Type</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                @foreach([
                    'tithesAndOffering',
                    'essentials',
                    'districtBudget',
                    'education',
                    'mission',
                    'WEF',
                    'donation',
                    'others'
                ] as $type)
                    <option value="{{ $type }}"
                        {{ $giving->type == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Amount -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Amount</label>
            <input type="number" step="0.01" name="amount"
                   value="{{ old('amount', $giving->amount) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Notes</label>
            <textarea name="notes"
                      class="w-full border rounded px-3 py-2">{{ old('notes', $giving->notes) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-2">
            <a href="{{ route('givings.index') }}"
               class="px-4 py-2 bg-gray-300 rounded">Cancel</a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>
        </div>

    </form>
</div>
</x-app-layout>