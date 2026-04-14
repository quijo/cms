<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Church
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- Back button -->
                <a href="{{ route('churches.index') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; Back to Churches</a>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('churches.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Church Name -->
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Church Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Church Number -->
                        <div>
                            <label for="church_number" class="block font-medium text-gray-700">Church Number</label>
                            <input id="church_number" name="church_number" type="text" value="{{ old('church_number') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="mission" {{ old('status') == 'mission' ? 'selected' : '' }}>Mission</option>
                                <option value="organized" {{ old('status') == 'organized' ? 'selected' : '' }}>Organized</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block font-medium text-gray-700">Start Date</label>
                            <input id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Contact Address -->
                        <div>
                            <label for="contact_address" class="block font-medium text-gray-700">Contact Address</label>
                            <input id="contact_address" name="contact_address" type="text" value="{{ old('contact_address') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Essential -->
<div>
    <label for="essential" class="block font-medium text-gray-700">Essential</label>
    <select name="essential" id="essential" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="">Select Essential</option>
        <option value="nmi" {{ old('essential') == 'nmi' ? 'selected' : '' }}>NMI</option>
        <option value="ndi" {{ old('essential') == 'ndi' ? 'selected' : '' }}>NDI</option>
        <option value="nyi" {{ old('essential') == 'nyi' ? 'selected' : '' }}>NYI</option>
    </select>
</div>
                       

                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">
                            Add Church
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>