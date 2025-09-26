<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'flat_id',
        'bill_category_id',
        'bill_month',
        'amount',
        'status',
        'due_amount',
        'notes',
        'paid_date',
        'due_date',
        'total_amount',
    ];


    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function billCategory()
    {
        return $this->belongsTo(BillCategory::class);
    }

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }
}
