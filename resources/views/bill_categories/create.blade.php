@extends('layouts.app')

@section('title', 'Add Bill Category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bill-category.index') }}">Bill Categories</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-plus-circle me-2"></i> Add Bill Category</h4>

            <form action="{{ route('bill-category.store') }}" method="POST">
                @csrf

                @if(Auth::user()->role === 'admin')
                    <div class="mb-3">
                        <label class="form-label">House Owner</label>
                        <select name="house_owner_id" class="form-control" required>
                            <option value="">-- Select Owner --</option>
                            @foreach($houseOwners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Default Amount</label>
                    <input type="number" step="0.01" name="default_amount" value="{{ old('default_amount') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success"><i class="fas fa-save me-2"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
