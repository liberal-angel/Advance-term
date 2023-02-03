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

    public function User(){
        return $this->hasMany(User::class);
    }
    
    public function Shop(){
        return $this->hasMany(Shop::class);
    }
}
