<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'podcast_id',
        'podcaster_id'
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
