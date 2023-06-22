<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_detail';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'price',
        'quantity',
        'note',
        'status_id',
        'staff_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function status()
    {
        return $this->hasMany(StatusInvoiceDetail::class, 'status_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'staff_id');
    }
}
