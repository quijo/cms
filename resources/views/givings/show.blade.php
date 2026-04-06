<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Giving Details</h2>

            <a href="{{ route('givings.index') }}" 
               class="text-sm bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Back
            </a>
        </div>

        <!-- Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Church -->
            <div>
                <p class="text-gray-500 text-sm">Church</p>
                <p class="font-semibold">
                    {{ $giving->church->name ?? 'N/A' }}
                </p>
            </div>

            <!-- Member -->
            <div>
                <p class="text-gray-500 text-sm">Member</p>
                <p class="font-semibold">
                    {{ $giving->member->name ?? 'N/A' }}
                </p>
            </div>

            <!-- OR Number -->
            <div>
                <p class="text-gray-500 text-sm">OR Number</p>
                <p class="font-semibold">{{ $giving->or_number }}</p>
            </div>

            <!-- Giving Date -->
            <div>
                <p class="text-gray-500 text-sm">Giving Date</p>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($giving->giving_date)->format('F d, Y') }}
                </p>
            </div>

            <!-- Type -->
            <div>
                <p class="text-gray-500 text-sm">Type of Giving</p>
                <p class="font-semibold capitalize">
                    {{ $giving->type }}
                </p>
            </div>

            <!-- Amount -->
            <div>
                <p class="text-gray-500 text-sm">Amount</p>
                <p class="font-semibold text-green-600">
                    ₱{{ number_format($giving->amount, 2) }}
                </p>
            </div>

            <!-- Payment Method -->
            <div>
                <p class="text-gray-500 text-sm">Payment Method</p>
                <p class="font-semibold">
                    {{ $giving->payment_method ?? 'N/A' }}
                </p>
            </div>

        </div>

        <!-- Notes -->
        <div class="mt-6">
            <p class="text-gray-500 text-sm">Notes</p>
            <p class="mt-1 bg-gray-100 p-3 rounded">
                {{ $giving->notes ?? 'No notes provided.' }}
            </p>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex gap-3">
            <a href="{{ route('givings.edit', $giving->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Edit
            </a>

            <form action="{{ route('givings.destroy', $giving->id) }}" method="POST"
                  onsubmit="return confirm('Delete this giving?')">
                @csrf
                @method('DELETE')

                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>

    </div>
</x-app-layout>