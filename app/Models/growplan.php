<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class growplan extends Model
{
    use HasFactory;

    protected $table = 'growplans';
    protected $fillable = [
        'customer_id',
        'title',
        'seed',
        'land',
        'soil',
        'tanggal',
    ];

    public function customer() {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
