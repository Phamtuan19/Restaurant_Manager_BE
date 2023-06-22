<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'cost_capital',
        'price',
        'price_sale',
        'description',
        'image',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function InvoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'product_id');
    }
}
