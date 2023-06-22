<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusInvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'status_invoice_detail';

    protected $fillable = [
        'name'
    ];

    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'status_id');
    }
}
