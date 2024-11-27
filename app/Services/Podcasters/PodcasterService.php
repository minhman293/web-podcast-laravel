<?php


namespace App\Services\Podcasters;

use App\Models\Podcaster;

class PodcasterService
{
    private Podcaster $podcaster;

    public function __construct(Podcaster $podcaster)
    {
        $this->podcaster = $podcaster;
    }
    
    public function getPodcasterById(int $id) 
    {
        return $this->podcaster::find($id);
    }

    public function update($podcaster,$params){
        // $podcaster->save();
        return $podcaster ->update($params);
    }
}