<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'transaction_reference',
        'notes',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
