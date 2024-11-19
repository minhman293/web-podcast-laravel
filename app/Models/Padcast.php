<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padcast extends Model
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
}
