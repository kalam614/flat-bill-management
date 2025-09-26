@extends('layouts.app')

@section('title', 'Bills')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Bills</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-file-invoice me-2"></i> Bills</h4>
        <a href="{{ route('bills.create') }}" class="btn btn-custom">
            <i class="fas fa-plus-circle me-2"></i> Add Bill
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Flat</th>
                        <th>Owner</th>
                        <th>Category</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bills as $bill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bill->flat->flat_number }}</td>
                            <td>{{ $bill->flat->flat_owner_name }}</td>
                            <td>{{ $bill->billCategory->name }}</td>
                            <td>{{ $bill->bill_month }}</td>
                            <td>৳{{ number_format($bill->amount, 2) }}</td>
                            <td>
                                @if ($bill->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($bill->status == 'overdue')
                                    <span class="badge bg-danger">Overdue</span>
                                @else
                                    <span class="badge bg-warning text-dark">Unpaid</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($bill->due_date)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-sm btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this bill?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No bills found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
@endsection
