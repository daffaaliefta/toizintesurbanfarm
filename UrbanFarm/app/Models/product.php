<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'customer_id',
        'nama',
        'photo',
        'category',
        'description',
        'harga',
        'quantity',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function customer() {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
