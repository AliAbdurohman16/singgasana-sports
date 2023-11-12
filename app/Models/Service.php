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
}
