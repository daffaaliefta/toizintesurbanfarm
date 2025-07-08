<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $fillable = [
        'customer_id',
        'title',
        'photo',
        'text',
    ];

    public function customer() {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
