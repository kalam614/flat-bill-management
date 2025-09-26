@extends('layouts.app')

@section('content')
<div class="container">
    <h1>House Owner Details</h1>

    <div class="card">
        <div class="card-body">
            <h4>{{ $houseOwner->user->name }}</h4>
            <p><strong>Email:</strong> {{ $houseOwner->user->email }}</p>
            <p><strong>Phone:</strong> {{ $houseOwner->phone }}</p>
            <p><strong>Address:</strong> {{ $houseOwner->address }}</p>
            <p><strong>Building:</strong> {{ $houseOwner->building_name }}</p>
            <p><strong>Building Address:</strong> {{ $houseOwner->building_address }}</p>
        </div>
    </div>

    <a href="{{ route('admin.house-owners.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection

