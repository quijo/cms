@extends('adminlte::page')

@section('title', 'Churches')

@section('content_header')
    <h1>Churches</h1>
@stop

@section('content')

    <!-- Add Church Button -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Churches</h3>
        <a href="{{ route('churches.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Church
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter/Search Form -->
    <form method="GET" action="{{ route('churches.index') }}" class="mb-3 d-flex flex-wrap gap-2">
        <input type="text" name="search" placeholder="Search churches..." value="{{ request('search') }}" class="form-control" style="max-width: 250px;">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('churches.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <!-- Churches Table -->
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Church Number</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Contact Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($churches as $church)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $church->name }}</td>
                            <td>{{ $church->church_number }}</td>
                            <td>{{ ucfirst($church->status) }}</td>
                            <td>{{ $church->start_date->format('M d, Y') }}</td>
                            <td>{{ $church->contact_address }}</td>
                            <td class="d-flex gap-1">

                                <!-- View -->
                                <a href="{{ route('churches.show', $church->id) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('churches.edit', $church->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('churches.destroy', $church->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this church?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No churches found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $churches->links() }}
    </div>

@stop