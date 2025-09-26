@extends('layouts.app')

@section('title', 'Edit Bill')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Bills</a></li>
    <li class="breadcrumb-item active">Edit Bill</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Edit Bill</h4>

            <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('bills.partials.form')
                <button type="submit" class="btn btn-custom mt-3">Update Bill</button>
                <a href="{{ route('bills.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
