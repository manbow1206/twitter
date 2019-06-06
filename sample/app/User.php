<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  public function follows()
  {
    return $this->belongsToMany(self::class, 'follows' , 'user_id' , 'follow_id')-> withTimestamps();
  }

  public function FollowingCheck($userId)
  {
    return $this->follows()->where('follow_id', $userId)->first();
  }

  public function likes()
  {
    return $this->belongsToMany('App\Http\Models\Post', 'likes' , 'user_id' , 'post_id')-> withTimestamps();
  }

  public function LikeCheck($postId)
  {
    return $this->likes()->where('post_id', $postId)->first();
  }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
