<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'name',
    ];

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
