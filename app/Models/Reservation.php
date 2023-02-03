<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'num_of_users',
        'start_at',
    ];

    public function item(){
        return $this->hasMany(User::class, Shop::class, 'foreign_key');
    }
}
