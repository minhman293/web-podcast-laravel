<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcasterFollower extends Model
{
    use HasFactory;

    // protected $table = 'podcaster_followers';

    protected $fillable = [
        'podcaster_id',
        'follower_id'
    ];
}
