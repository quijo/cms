@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Total Members -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMembers }}</h3>
                    <p>Total Members</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Active Members -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $activeMembers }}</h3>
                    <p>Active Members</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        <!-- Total Churches -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalChurches }}</h3>
                    <p>Total Churches</p>
                </div>
                <div class="icon">
                    <i class="fas fa-church"></i>
                </div>
            </div>
        </div>

        <!-- Total Giving -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($totalGiving, 2) }}</h3>
                    <p>Total Giving</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Giving by Type Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Giving by Type</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($givingsByType as $giving)
                        <tr>
                            <td>{{ ucfirst($giving->type) }}</td>
                            <td>{{ number_format($giving->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop