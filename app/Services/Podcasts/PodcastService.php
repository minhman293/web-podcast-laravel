<?php


namespace App\Services\Podcasts;

use App\Models\Podcast;

class PodCastService 
{
    private Podcast $podcast;

    public function __construct(Podcast $podcast) {
        $this->podcast = $podcast;
    }

    public function getPodcastsByPodcasterId(int $podcasterId) {
        return $this->podcast::where('podcaster_id', $podcasterId)->get();
    }
}