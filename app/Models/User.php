<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function houseOwner()
    {
        return $this->hasOne(HouseOwner::class);
    }


    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isHouseOwner(): bool
    {
        return $this->role === 'house_owner';
    }
}
