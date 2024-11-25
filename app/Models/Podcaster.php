<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Podcaster extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'google_id',
        'facebook_id'
    ];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class, 'podcaster_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'podcaster_id');
    }
}