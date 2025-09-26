@extends('layouts.app')

@section('title', 'My Flats')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">My Flats</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-home me-2"></i> My Flats</h4>
        <a href="{{ route('flats.create') }}" class="btn btn-custom">
            <i class="fas fa-plus-circle me-2"></i> Add Flat
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Flat Number</th>
                        <th>Owner Name</th>
                        <th>Owner Phone</th>
                        <th>Monthly Rent</th>
                        <th>Tenant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($flats as $flat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $flat->flat_number }}</td>
                            <td>{{ $flat->flat_owner_name }}</td>
                            <td>{{ $flat->flat_owner_phone }}</td>
                            <td>{{ $flat->monthly_rent ? '৳' . $flat->monthly_rent : '-' }}</td>
                            <td>
                                @if ($flat->tenant)
                                    <span class="badge bg-success">{{ $flat->tenant->name }}</span>
                                @else
                                    <span class="badge bg-secondary">Vacant</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('flats.show', $flat->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('flats.edit', $flat->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('flats.destroy', $flat->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this flat?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No flats found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $flats->links() }}
            </div>
        </div>
    </div>
@endsection
