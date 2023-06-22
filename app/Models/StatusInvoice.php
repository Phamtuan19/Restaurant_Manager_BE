<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusInvoice extends Model
{
    use HasFactory;

    protected $table = 'status_invoice';

    protected $fillable = [
        'name'
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'status_id');
    }
}
