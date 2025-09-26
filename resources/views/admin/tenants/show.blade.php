@extends('layouts.app')

@section('title', 'Tenant Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tenants.index') }}">Tenants</a></li>
    <li class="breadcrumb-item active">Tenant Details</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-user me-2"></i>Tenant Details</h4>

            <p><strong>Name:</strong> {{ $tenant->name }}</p>
            <p><strong>Email:</strong> {{ $tenant->email }}</p>
            <p><strong>Phone:</strong> {{ $tenant->phone }}</p>
            <p><strong>Address:</strong> {{ $tenant->address ?? '-' }}</p>
            <p><strong>House Owner:</strong> {{ $tenant->houseOwner->user->name ?? '-' }}</p>
            <p><strong>Flat:</strong> {{ $tenant->flat->flat_number ?? '-' }}</p>
            <p><strong>Move In:</strong> {{ $tenant->move_in_date ?? '-' }}</p>
            <p><strong>Move Out:</strong> {{ $tenant->move_out_date ?? '-' }}</p>

            <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
@endsection
