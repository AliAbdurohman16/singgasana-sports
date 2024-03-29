<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingMembers()
    {
        return $this->hasMany(BookingMember::class);
    }

    public function bookingDailies()
    {
        return $this->hasMany(BookingDaily::class);
    }

    public function priceDailies()
    {
        return $this->hasMany(PriceDaily::class);
    }

    public function priceMembers()
    {
        return $this->hasMany(PriceMember::class);
    }
}
