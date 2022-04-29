<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'username',
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

    /**
     * Get the likes for the user.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the sales for the user.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the Roles that owns the User
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if current user has any role
     * @param string $role
     * @return bool
     */
    public function hasAnyRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Get user's full name
     */
    public function getFullName(){
        return $this->first_name.' '.$this->last_name ;
    }
}
