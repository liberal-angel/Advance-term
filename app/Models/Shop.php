<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'area_id',
        'genre_id',
        'discription',
        'image_url',
    ];

    public function Item(){
        return $this->hasMany(Area::class, Genre::class, 'foreign_key');
    }

    public function Reservation(){
        return $this->belongsToMany(Reservation::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class, Like::class)->withTimestamps();
    }

    public function rates(){
        return $this->belongsToMany(Rate::class)->withTimestamps();
    }
}
