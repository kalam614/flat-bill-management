<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;

class BillPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $paidAmount;

    public function __construct(Bill $bill, $paidAmount)
    {
        $this->bill = $bill;
        $this->paidAmount = $paidAmount;
    }

    public function build()
    {
        return $this->subject("Payment Received for Bill #{$this->bill->id}")
            ->view('emails.bills.bill-paid')
            ->with([
                'bill' => $this->bill,
                'paidAmount' => $this->paidAmount,
            ]);
    }
}
