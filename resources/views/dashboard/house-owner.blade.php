@extends('layouts.app')

@section('title', 'House Owner Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">
                <i class="fas fa-tachometer-alt me-2"></i>
                House Owner Dashboard
            </h2>
            <p class="text-muted">Welcome back, {{ auth()->user()->name }}! Here’s your building overview.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-home fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['total_flats'] }}</h3>
                    <p class="mb-0 small">Total Flats</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-door-open fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['occupied_flats'] }}</h3>
                    <p class="mb-0 small">Occupied Flats</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-friends fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['total_tenants'] }}</h3>
                    <p class="mb-0 small">Active Tenants</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-white h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['unpaid_bills'] }}</h3>
                    <p class="mb-0 small">Unpaid Bills</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-white h-100" style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['overdue_bills'] }}</h3>
                    <p class="mb-0 small">Overdue Bills</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-white h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-center">
                    <i class="fas fa-coins fa-2x mb-3"></i>
                    <h3 class="mb-1">৳{{ number_format($stats['monthly_revenue'], 2) }}</h3>
                    <p class="mb-0 small">Monthly Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Bills -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Recent Bills
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if ($recentBills->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Flat</th>
                                        <th>Category</th>
                                        <th>Month</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentBills as $bill)
                                        <tr>
                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    {{ $bill->flat->flat_number }}
                                                </span>
                                            </td>
                                            <td>{{ $bill->billCategory->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bill->bill_month)->format('M Y') }}</td>
                                            <td>
                                                <strong>৳{{ number_format($bill->total_amount, 2) }}</strong>
                                            </td>
                                            <td>
                                                @if ($bill->status === 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($bill->status === 'overdue')
                                                    <span class="badge bg-danger">Overdue</span>
                                                @else
                                                    <span class="badge bg-warning">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No bills found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('flats.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>
                            Add Flat
                        </a>

                        <a href="{{ route('bills.create') }}" class="btn btn-outline-info">
                            <i class="fas fa-file-invoice-dollar me-2"></i>
                            Create Bill
                        </a>
                    </div>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-building me-2"></i>
                        Building Info
                    </h5>
                </div>
                <div class="card-body">
                    <p><strong>Building:</strong> {{ auth()->user()->houseOwner->building_name }}</p>
                    <p><strong>Address:</strong> {{ auth()->user()->houseOwner->building_address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
