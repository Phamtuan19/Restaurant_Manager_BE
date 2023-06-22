<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'table_code',
        'floor_id',
        'area_id',
        'status_id',
        'index_table',
        'total_user_sitting',
        'description',
        'user_id',
    ];

    public function statusTable()
    {
        return $this->hasMany(StatusTable::class, 'status_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'table_id');
    }
}
