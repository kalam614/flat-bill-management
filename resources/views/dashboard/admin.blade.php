
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">
                <i class="fas fa-tachometer-alt me-2"></i>
                Admin Dashboard
            </h2>
            <p class="text-muted">Welcome back, {{ auth()->user()->name }}! Here's your system overview.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['total_house_owners'] }}</h3>
                    <p class="mb-0 small">House Owners</p>
                </div>
            </div>
        </div>

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
                    <i class="fas fa-user-friends fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['total_tenants'] }}</h3>
                    <p class="mb-0 small">Total Tenants</p>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-file-invoice fa-2x mb-3"></i>
                    <h3 class="mb-1">{{ $stats['total_bills'] }}</h3>
                    <p class="mb-0 small">Total Bills</p>
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
            <div class="card text-white h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-2x mb-3"></i>
                    <h3 class="mb-1">
                        {{ number_format((($stats['total_bills'] - $stats['unpaid_bills']) / max($stats['total_bills'], 1)) * 100, 1) }}%
                    </h3>
                    <p class="mb-0 small">Collection Rate</p>
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
                    {{-- <a href="{{ route('admin.bills.index') }}" class="btn btn-sm btn-outline-primary">View All</a> --}}
                </div>
                <div class="card-body p-0">
                    @if ($recentBills->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>House Owner</th>
                                        <th>Flat</th>
                                        <th>Category</th>
                                        <th>Month</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentBills as $bill)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-circle fa-lg me-2 text-primary"></i>
                                                    <div>
                                                        <div class="fw-bold">{{ $bill->houseOwner->user->name }}</div>
                                                        <small
                                                            class="text-muted">{{ $bill->houseOwner->building_name }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-light text-dark">{{ $bill->flat->flat_number }}</span>
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
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    {{-- <a href="{{ route('admin.bills.show', $bill) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a> --}}
                                                </div>
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
                        <a href="{{ route('admin.house-owners.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>
                            Add House Owner
                        </a>
                        <a href="{{ route('admin.tenants.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>
                            Add Tenant
                        </a>
                        {{-- <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-chart-bar me-2"></i>
                            Generate Reports
                        </a> --}}
                        {{-- <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-cog me-2"></i>
                            System Settings
                        </a> --}}
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        System Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Database Status</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Last Backup</span>
                        <small class="text-muted">2 hours ago</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Active Users</span>
                        <span class="badge bg-info">{{ $stats['total_house_owners'] + 1 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-refresh statistics every 30 seconds
        setInterval(function() {
            // You can implement AJAX refresh here if needed
        }, 30000);
    </script>
@endsection
