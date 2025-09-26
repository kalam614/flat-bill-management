@extends('layouts.app')

@section('title', 'Edit Bill Category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bill-category.index') }}">Bill Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-edit me-2"></i> Edit Bill Category</h4>

            <form action="{{ route('bill-category.update', $billCategory->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if (Auth::user()->role === 'admin')
                    <div class="mb-3">
                        <label class="form-label">House Owner</label>
                        <select name="house_owner_id" class="form-control" required>
                            @foreach ($houseOwners as $owner)
                                <option value="{{ $owner->id }}"
                                    {{ $billCategory->house_owner_id == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $billCategory->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $billCategory->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Default Amount</label>
                    <input type="number" step="0.01" name="default_amount" value="{{ $billCategory->default_amount }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $billCategory->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$billCategory->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success"><i class="fas fa-save me-2"></i> Update</button>
            </form>
        </div>
    </div>
@endsection
