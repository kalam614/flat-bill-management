<?php

namespace App\Mail;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;

    /**
     * Create a new message instance.
     */
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Bill Generated - ' . $this->bill->bill_month)
            ->markdown('emails.bills.created');
    }
}
