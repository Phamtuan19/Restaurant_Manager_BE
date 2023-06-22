<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTable extends Model
{
    use HasFactory;

    protected $table = 'status_table';

    protected $fillable = [
        'name'
    ];

    public function tables()
    {
        return $this->hasMany(Tables::class, 'status_id');
    }
}
