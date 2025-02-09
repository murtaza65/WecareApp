<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phoneno',
        'terms_and_conditions',

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
    public function profile()
    {
        # code...
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function messages()
    {
        # code...
        return $this->hasMany(Messages::class, 'user_id');
    }

    public function likes()
    {
        # code...
        return $this->hasMany(Like::class, 'user_id');
    }
    public function goals()
    {
        # code...
        return $this->hasMany(Goal::class, 'user_id');
    }

    public function reminders()
    {
        # code...
        return $this->hasMany(Reminder::class, 'user_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_user');
    }

    public function myCommunities()
    {
        return $this->hasMany(Community::class, 'created_by');
    }

}
