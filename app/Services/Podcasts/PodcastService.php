<?php


namespace App\Services\Podcasts;

use App\Models\Podcast;
use Exception;
use Illuminate\Support\Facades\Log;

class PodcastService 
{
    private Podcast $podcast;

    public function __construct(Podcast $podcast) {
        $this->podcast = $podcast;
    }

    public function getLastPodCastByPodcasterId($podcasterId) {
        try {
            return $this->podcast::where('podcaster_id', $podcasterId)->latest()->first();
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
   }

    public function getPodcastsByPodcasterId(int $podcasterId) {
        return $this->podcast::where('podcaster_id', $podcasterId)->get();
    }
}