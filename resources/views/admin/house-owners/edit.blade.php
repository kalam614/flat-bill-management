@extends('layouts.app')

@section('title', 'Edit House Owner')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.house-owners.index') }}">House Owners</a></li>
    <li class="breadcrumb-item active">Edit House Owner</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Edit House Owner</h4>

            <form action="{{ route('admin.house-owners.update', $houseOwner) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.house-owners.partials.form', ['houseOwner' => $houseOwner])

                <button type="submit" class="btn btn-custom mt-3">Update Owner</button>
                <a href="{{ route('admin.house-owners.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
