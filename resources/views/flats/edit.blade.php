@extends('layouts.app')

@section('title', 'Edit Flat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('flats.index') }}">My Flats</a></li>
    <li class="breadcrumb-item active">Edit Flat</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Edit Flat</h4>

            <form action="{{ route('flats.update', $flat->id) }}" method="POST">
                @csrf @method('PUT')
                @include('flats.partials.form', ['flat' => $flat])
                <button type="submit" class="btn btn-custom mt-3">Update Flat</button>
                <a href="{{ route('flats.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
