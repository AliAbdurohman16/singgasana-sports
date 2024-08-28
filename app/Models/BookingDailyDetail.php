<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDailyDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingDaily()
    {
        return $this->belongsTo(BookingDaily::class);
    }
}
