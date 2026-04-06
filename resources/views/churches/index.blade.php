@extends('adminlte::page')

@section('title', 'Churches')

@section('content_header')
    <h1>Churches</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Bulk Delete Form --}}
    <form action="{{ route('churches.bulkDelete') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Churches</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete selected churches?')">
                        Delete Selected
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($churches as $church)
                            <tr>
                                <td>
                                    <input type="checkbox" name="churches[]" value="{{ $church->id }}" class="select-item">
                                </td>
                                <td>{{ $church->id }}</td>
                                <td>{{ $church->name }}</td>
                                <td>{{ $church->location }}</td>
                                <td>
                                    <a href="{{ route('churches.show', $church->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('churches.edit', $church->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteChurch({{ $church->id }})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No churches found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                {{ $churches->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </form>

    {{-- Hidden form for single row delete --}}
    <form id="delete-form" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

@stop

@section('js')
<script>
    // Select/Deselect all checkboxes
    document.getElementById('select-all').addEventListener('change', function(e){
        document.querySelectorAll('.select-item').forEach(cb => cb.checked = e.target.checked);
    });

    // Single row delete function
    function deleteChurch(id) {
        if(confirm('Are you sure you want to delete this church?')) {
            let form = document.getElementById('delete-form');
            form.action = `/churches/${id}`; // Make sure your destroy route matches this
            form.submit();
        }
    }
</script>
@stop