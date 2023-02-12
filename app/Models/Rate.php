<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'rate',
        'comment',
    ];

    public function item(){
        return $this->hasMany(User::class, Shop::class, 'foreign_key');
    }
}
