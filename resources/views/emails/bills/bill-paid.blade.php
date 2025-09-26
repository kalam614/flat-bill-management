<h4>Payment Received</h4>
<p>Dear {{ $bill->flat->flat_owner_name }},</p>

<p>We have received a payment of <strong>৳{{ $paidAmount }}</strong> for your bill ({{ $bill->billCategory->name }})
    for {{ $bill->bill_month }}.</p>

<p>Bill Details:</p>
<ul>
    <li>Total Amount: ৳{{ $bill->total_amount }}</li>
    <li>Paid Amount: ৳{{ $bill->total_amount - $bill->due_amount }}</li>
    <li>Due Amount: ৳{{ $bill->due_amount }}</li>
    <li>Status: {{ ucfirst($bill->status) }}</li>
</ul>

<p>Thank you.</p>
