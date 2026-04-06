@extends('adminlte::page') <!-- Extends AdminLTE layout -->

@section('title', 'Givings') <!-- Page title -->

@section('content_header')
    <h1>Givings</h1>
@stop

@section('content')
    <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Givings</h3>
        <a href="{{ route('givings.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Add Giving
        </a>
    </div>

    <div class="card-body">

        <!-- Search Form -->
        <form method="GET" action="{{ route('givings.index') }}" class="form-inline mb-3">
            <input 
                type="text" 
                name="church_name" 
                value="{{ request('church_name') }}" 
                placeholder="Search by Church Name"
                class="form-control form-control-sm mr-2"
            />

            <button type="submit" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-search"></i> Search
            </button>

            @if(request('church_name'))
                <a href="{{ route('givings.index') }}" class="btn btn-secondary btn-sm">
                    Clear
                </a>
            @endif
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Church</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Notes</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($givings as $giving)
                        <tr>
                            <td>{{ $giving->id }}</td>
                            <td>{{ $giving->church->name ?? 'N/A' }}</td>
                            <td>{{ number_format($giving->amount, 2) }}</td>
                            <td>{{ $giving->type }}</td>
                            <td>{{ $giving->created_at->format('M d, Y') }}</td>
                            <td>{{ $giving->notes ?? '-' }}</td>

                            <td class="text-center">
                                <div class="btn-group ">
                                    <!-- View -->
                                    <a href="{{ route('givings.show', $giving->id) }}"
                                       class="btn btn-info btn-sm mr-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('givings.edit', $giving->id) }}"
                                       class="btn btn-primary btn-sm mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('givings.destroy', $giving->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this giving?');"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No givings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div class="card-footer clearfix">
        {{ $givings->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection









