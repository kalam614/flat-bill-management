@extends('layouts.app')

@section('title', 'Flat Details')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('flats.index') }}">My Flats</a></li>
<li class="breadcrumb-item active">Flat Details</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3"><i class="fas fa-home me-2"></i> Flat Details</h4>

        <table class="table table-bordered">
            <tr><th>Flat Number</th><td>{{ $flat->flat_number }}</td></tr>
            <tr><th>Owner Name</th><td>{{ $flat->flat_owner_name }}</td></tr>
            <tr><th>Owner Phone</th><td>{{ $flat->flat_owner_phone }}</td></tr>
            <tr><th>Owner Email</th><td>{{ $flat->flat_owner_email }}</td></tr>
            <tr><th>Monthly Rent</th><td>{{ $flat->monthly_rent ? '৳'.$flat->monthly_rent : '-' }}</td></tr>
            <tr><th>Tenant</th>
                <td>
                    @if($flat->tenant)
                        <span class="badge bg-success">{{ $flat->tenant->name }}</span>
                    @else
                        <span class="badge bg-secondary">Vacant</span>
                    @endif
                </td>
            </tr>
            <tr><th>Notes</th><td>{{ $flat->notes ?? '-' }}</td></tr>
        </table>

        <a href="{{ route('flats.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
