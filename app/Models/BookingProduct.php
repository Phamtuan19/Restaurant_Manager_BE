<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
    use HasFactory;

    protected $table = "booking_products";

    protected $fillable = [
        'booking_id',
        'product_id',
        'quantity',
    ];

    public function boongking()
    {
        return $this->belongsTo(Booking::class, 'boongking_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
