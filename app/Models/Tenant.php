<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'flat_id',
        'name',
        'email',
        'phone',
        'address',
        'move_in_date',
        'move_out_date',
        'is_active',
    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }
}
