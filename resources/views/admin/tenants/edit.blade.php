@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tenants.index') }}">Tenants</a></li>
    <li class="breadcrumb-item active">Edit Tenant</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Edit Tenant</h4>

            <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST">
                @csrf @method('PUT')
                @include('admin.tenants.partials.form', ['tenant' => $tenant])
                <button type="submit" class="btn btn-custom mt-3">Update Tenant</button>
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
