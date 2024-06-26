<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'end_user',
        'course_id',
        'role',
        'isReceiver',
        'email',
        'password',
        'department_id',
        'course', 
        'education', 
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
        'password' => 'hashed',
    ];

    public function documents () : HasMany 
    { 
        return $this->hasMany(Document::class);
    }
    public function interview () : HasMany 
    { 
        return $this->hasMany(Interview::class);
    }

    public function department() : BelongsTo{
        return $this->belongsTo(Department::class);
    }

    public function forwardedDocs() :HasMany{
        return $this->hasMany(ForwardToDept::class, 'receiver_id');
    }
}
