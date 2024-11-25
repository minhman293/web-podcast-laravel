<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'audio',
        'image',
        'duration',
        'category_id',
        'podcaster_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'podcast_id');
    }

    public function podcaster()
    {
        return $this->belongsTo(Podcaster::class, 'podcaster_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
