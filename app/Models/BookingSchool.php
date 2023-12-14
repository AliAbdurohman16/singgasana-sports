<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSchool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingMember()
    {
        return $this->belongsTo(BookingMember::class);
    }
}
