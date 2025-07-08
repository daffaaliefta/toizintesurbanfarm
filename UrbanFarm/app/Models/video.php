<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $fillable = [
        'customer_id',
        'title',
        'photo',
        'description',
    ];

    public function customer() {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
