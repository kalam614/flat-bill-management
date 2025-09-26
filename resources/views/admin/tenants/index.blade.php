@extends('layouts.app')

@section('title', 'Tenants')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tenants</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-users me-2"></i> Tenants</h4>
        <a href="{{ route('admin.tenants.create') }}" class="btn btn-custom">
            <i class="fas fa-plus-circle me-2"></i> Add Tenant
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>House Owner</th>
                        <th>Flat</th>
                        <th>Move In</th>
                        <th>Move Out</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tenants as $tenant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>{{ $tenant->phone }}</td>
                            <td>{{ $tenant->houseOwner->user->name ?? '-' }}</td>
                            <td>{{ $tenant->flat->flat_number ?? '-' }}</td>
                            <td>{{ $tenant->move_in_date ?? '-' }}</td>
                            <td>{{ $tenant->move_out_date ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.tenants.show', $tenant->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this tenant?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No tenants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $tenants->links() }}
            </div>
        </div>
    </div>
@endsection
