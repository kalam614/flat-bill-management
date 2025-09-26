@extends('layouts.app')

@section('title', 'Add Tenant')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tenants.index') }}">Tenants</a></li>
    <li class="breadcrumb-item active">Add Tenant</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-plus-circle me-2"></i>Add Tenant</h4>

            <form action="{{ route('admin.tenants.store') }}" method="POST">
                @csrf
                @include('admin.tenants.partials.form', ['tenant' => null])
                <button type="submit" class="btn btn-custom mt-3">Save Tenant</button>
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
