<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;



    public function interests()
    {
        return $this->hasMany(user_interest::class);
    }
    public function hobbies()
    {
        return $this->hasMany(user_hobby::class);
    }
    public function pictures()
    {
        return $this->hasMany(user_picture::class);
    }
    public function notifs()
    {
        return $this->hasMany(user_notification::class);
    }
    public function type()
    {
        return $this->belongsTo(user_type::class,"user_type_id");
    }

    public function connections()
{
  return $this->belongsToMany(User::class, 'user_connections', 'user1_id', 'user2_id');
}

public function favorites()
{
  return $this->belongsToMany(User::class, 'user_favorites', 'from_user_id', 'to_user_id');
}

public function blocked()
{
  return $this->belongsToMany(User::class, 'user_blocked','from_user_id', 'to_user_id');
}

public function messages()
{
  return $this->belongsToMany(User::class, 'user_messages', 'sender_id', 'receiver_id')->withPivot('body','is_approved');
}




    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'dob',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [];
}
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
