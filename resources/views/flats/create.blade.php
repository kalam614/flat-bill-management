@extends('layouts.app')

@section('title', 'Add Flat')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('flats.index') }}">My Flats</a></li>
<li class="breadcrumb-item active">Add Flat</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3"><i class="fas fa-plus-circle me-2"></i>Add Flat</h4>

        <form action="{{ route('flats.store') }}" method="POST">
            @csrf
            @include('flats.partials.form')
            <button type="submit" class="btn btn-custom mt-3">Save Flat</button>
            <a href="{{ route('flats.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection
