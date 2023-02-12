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
        'admin_id',
        'discription',
        'image_url',
    ];

    public function item()
    {
        return $this->hasMany(Admin::class, Area::class, Genre::class, 'foreign_key');
    }

    public function reservation()
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, Like::class)->withTimestamps();
    }

    public function rates()
    {
        return $this->belongsToMany(Rate::class)->withTimestamps();
    }

    public function isSelectedArea($area_id)
    {
        return $this->area_id == $area_id ? 'selected' : "";
    }

    public function isSelectedGenre($genre_id)
    {
        return $this->genre_id == $genre_id ? 'selected' : "";
    }
}
