@component('mail::message')
    # New Bill Generated

    Hello {{ $bill->flat->flat_owner_name }},

    A new bill has been generated for your flat **{{ $bill->flat->flat_number }}**.

    - **Category:** {{ $bill->billCategory->name }}
    - **Month:** {{ $bill->bill_month }}
    - **Amount:** ৳{{ number_format($bill->amount, 2) }}
    - **Due Date:** {{ \Carbon\Carbon::parse($bill->due_date)->format('d M, Y') }}
    - **Status:** {{ ucfirst($bill->status) }}

    @isset($bill->notes)
        **Notes:**
        {{ $bill->notes }}
    @endisset

    @component('mail::button', ['url' => route('bills.show', $bill->id)])
        View Bill
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
