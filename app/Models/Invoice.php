<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'user_id',
        'table_id',
        'total_price',
        'quantity',
        'status_id',
        'staff_id',
    ];

    public function status()
    {
        return $this->belongsTo(StatusInvoice::class, 'status_id');
    }

    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }
}
