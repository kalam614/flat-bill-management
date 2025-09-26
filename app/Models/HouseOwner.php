<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'building_name',
        'building_address'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }


    public function billCategories()
    {
        return $this->hasMany(BillCategory::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
