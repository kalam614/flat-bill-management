@extends('layouts.app')

@section('title', 'Add House Owner')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.house-owners.index') }}">House Owner</a></li>
    <li class="breadcrumb-item active">Add House Owner</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-plus-circle me-2"></i>Add House Owner</h4>

            <form action="{{ route('admin.house-owners.store') }}" method="POST">
                @csrf
                @include('admin.house-owners.partials.form')
                <button type="submit" class="btn btn-custom mt-3">Save House Owner</button>
                <a href="{{ route('admin.house-owners.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
