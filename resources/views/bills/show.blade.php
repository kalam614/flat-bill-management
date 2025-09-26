@extends('layouts.app')

@section('title', 'Bill Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Bills</a></li>
    <li class="breadcrumb-item active">Bill Details</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-file-invoice me-2"></i> Bill Details</h4>

            <table class="table table-bordered">
                <tr>
                    <th>Flat</th>
                    <td>{{ $bill->flat->flat_number }}</td>
                </tr>
                <tr>
                    <th>Owner</th>
                    <td>{{ $bill->flat->flat_owner_name }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $bill->billCategory->name }}</td>
                </tr>
                <tr>
                    <th>Month</th>
                    <td>{{ $bill->bill_month }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>৳{{ number_format($bill->amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>৳{{ number_format($bill->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($bill->status) }}</td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>{{ \Carbon\Carbon::parse($bill->due_date)->format('d M, Y') }}</td>
                </tr>
                <tr>
                    <th>Paid Date</th>
                    <td>{{ $bill->paid_date ? \Carbon\Carbon::parse($bill->paid_date)->format('d M, Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $bill->notes ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('bills.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
        @if ($bill->due_amount > 0)
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#payModal">
                Pay Bill
            </button>

            <div class="modal fade" id="payModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('bills.pay', $bill->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pay Bill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Amount to Pay</label>
                                    <input type="number" step="0.01" max="{{ $bill->due_amount }}" name="amount_paid"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Payment Date</label>
                                    <input type="date" name="payment_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <input type="text" name="payment_method" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Transaction Reference</label>
                                    <input type="text" name="transaction_reference" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Notes</label>
                                    <textarea name="notes" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Pay</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>


@endsection
