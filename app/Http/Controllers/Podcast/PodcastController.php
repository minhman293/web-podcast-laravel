<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcaster;
use App\Models\Podcast;
use App\Models\Comment;
use App\Models\Category;

class PodcastController extends Controller
{
    public function index() {
        $podcasters = Podcaster::withCount('podcasts')->get();
        $podcasts = Podcast::all();
        return view('index', compact('podcasters', 'podcasts'));
    }

    public function podcast_detail($category, $id) {
        // Lấy podcast đang được hiển thị
        $podcast = Podcast::with(['podcaster', 'comments', 'category'])->findOrFail($id);
    
        // Kiểm tra xem category có khớp với category của podcast hay không
        if ($podcast->category->name !== $category) {
            abort(404);
        }
    
        // Lấy danh sách podcaster và số podcast của mỗi podcaster
        $podcasters = Podcaster::withCount('podcasts')->get();
    
        // Lấy danh sách các podcast còn lại ngoài podcast đang được hiển thị
        $otherPodcasts = Podcast::where('id', '!=', $id)->get();
    
        return view('/podcast/single-podcast', compact('podcast', 'podcasters', 'otherPodcasts'));
    }
}
