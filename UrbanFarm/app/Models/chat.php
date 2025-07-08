<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;

    protected $table = 'chats';
    protected $fillable = [
        'customer_id',
        'name',
        'description',
    ];

    public function customer() {
        return $this->hasMany(customer::class, 'customer_id', 'id');
    }
}
