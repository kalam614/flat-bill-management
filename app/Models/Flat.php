<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'flat_number',
        'flat_owner_name',
        'flat_owner_phone',
        'flat_owner_email',
        'monthly_rent',
        'notes',
        'is_occupied',
    ];

    // Relationships
    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
