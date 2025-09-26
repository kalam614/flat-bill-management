@extends('layouts.app')

@section('title', 'Add Bill')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Bills</a></li>
<li class="breadcrumb-item active">Add Bill</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3"><i class="fas fa-plus-circle me-2"></i>Add Bill</h4>

        <form action="{{ route('bills.store') }}" method="POST">
            @csrf
            @include('bills.partials.form')
            <button type="submit" class="btn btn-custom mt-3">Save Bill</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection
