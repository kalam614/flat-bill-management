@extends('layouts.app')

@section('title', 'House Owners')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">House Owners</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-users me-2"></i> House Owners</h4>
        <a href="{{ route('admin.house-owners.create') }}" class="btn btn-custom">
            <i class="fas fa-plus-circle me-2"></i> Add New Owner
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Owner Name</th>
                        <th>Email</th>
                        <th>Building</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($houseOwners as $owner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $owner->user->name }}</td>
                            <td>{{ $owner->user->email }}</td>
                            <td>{{ $owner->building_name }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>
                                <a href="{{ route('admin.house-owners.show', $owner) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.house-owners.edit', $owner) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.house-owners.destroy', $owner) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this owner?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No house owners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $houseOwners->links() }}
            </div>
        </div>
    </div>
@endsection
