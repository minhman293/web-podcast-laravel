<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'podcast_id',
        'content',
        'is_seen'
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class, 'podcast_id');
    }

    public function podcaster()
    {
        return $this->belongsTo(Podcaster::class, 'podcaster_id');
    }
}
