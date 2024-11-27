<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PodcasterFollower extends Model
{
    use HasFactory, SoftDeletes;

    // protected $table = 'podcaster_followers';
    protected $primaryKey = ['podcaster_id', 'follower_id'];
    public $incrementing = false;

    protected $fillable = [
        'podcaster_id',
        'follower_id'
    ];

    public $incrementing = false;

    public function podcaster_follow()
    {
        return $this->belongsTo(Podcaster::class, 'podcaster_id');
    }

    public function follower_follows()
    {
        return $this->belongsTo(Podcaster::class, 'follower_id');
    }
}
