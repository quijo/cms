

<x-app-layout>

<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Pastors</h1>

    <a href="{{ route('pastors.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded">
        Add Pastor
    </a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Church</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pastors as $pastor)
            <tr class="border-t">
                <td class="p-2">{{ $pastor->full_name }}</td>
                <td>{{ $pastor->role }}</td>
                <td>{{ $pastor->status }}</td>
                <td>{{ $pastor->church->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('pastors.edit', $pastor) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-app-layout>
