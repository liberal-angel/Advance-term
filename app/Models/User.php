<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザーを所有している予約を取得
    public function reservation(){
        return $this->belongsToMany(Reservation::class);
    }

    public function likes(){
        return $this->belongsToMany(Shop::class,'likes','user_id','shop_id')->withTimestamps();
    }

    public function rates(){
        return $this->belongsToMany(Rate::class)->withTimestamps();
    }

    //このコンテンツに対して既にlikeしたかどうかを判別する
    public function isLike($shopId)
    {
      return $this->likes()->where('shop_id',$shopId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($shopId)
    {
      if($this->isLike($shopId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->likes()->attach($shopId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($shopId)
    {
      if($this->isLike($shopId)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($shopId);
      } else {
      }
    }
}
