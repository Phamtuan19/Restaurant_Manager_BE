<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'booking_code',
        'table_id',
        'user_id',
        'booking_date',
        'booking_time',
        'party_size',
        'status_booking_id',
        'booking_notes',
    ];
}
