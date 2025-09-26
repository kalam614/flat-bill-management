@extends('layouts.app')

@section('title', 'Bill Categories')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Bill Categories</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-file-invoice me-2"></i> Bill Categories</h4>
        <a href="{{ route('bill-category.create') }}" class="btn btn-custom">
            <i class="fas fa-plus-circle me-2"></i> Add Category
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Default Amount</th>
                        <th>Status</th>
                        @if (auth()->user()->isAdmin())
                            <th>House Owner</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($billCategories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>{{ $category->default_amount ? '৳' . $category->default_amount : '-' }}</td>
                            <td>
                                @if ($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            @if (auth()->user()->isAdmin())
                                <td>{{ $category->houseOwner->user->name ?? '-' }}</td>
                            @endif
                            <td>
                                <a href="{{ route('bill-category.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('bill-category.destroy', $category->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No bill categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $billCategories->links() }}
            </div>
        </div>
    </div>
@endsection
