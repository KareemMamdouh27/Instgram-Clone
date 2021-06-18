<?php

namespace App\Models;

use App\Models\Profile;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);

            // Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    ### Relation With User's Profile ###
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    ### Relation With User's Posts
    public function posts()
    {
        return $this->hasMany(Post::class)->OrderBy('created_at', 'DESC');
    }


    ### Many To Many RelationShip With Profiles WHo can Follow ###
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
}
