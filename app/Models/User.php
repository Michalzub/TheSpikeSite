<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // User.php Model
    public function favoriteAgents()
    {
        return $this->belongsToMany(Agent::class);
    }

    public function favoriteMaps()
    {
        return $this->belongsToMany(Map::class);
    }

    public function favoriteWeapons()
    {
        return $this->belongsToMany(Weapon::class);
    }

    public function posts()
    {
        return $this->hasMany(Discussion::class);
    }



}
