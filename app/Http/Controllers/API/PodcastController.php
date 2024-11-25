<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Models\Podcaster;

class PodcastController extends Controller
{

// --------------------------------
// WEB CONTROLLER
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

    public function about() {
        $podcasters = Podcaster::withCount('podcasts')
                                ->orderBy('podcasts_count', 'desc')
                                ->take(3)
                                ->get();
        return view('about', compact('podcasters'));
    }

// --------------------------------
// API CONTROLLER
    public function show_podcast_list (Request $request)
    {
        // Show all podcasts
        $podcasts = Podcast::paginate(5);

        return response()->json([
            'status' => 1,
            'message' => 'All podcasts fetched.',
            'data' => $podcasts
        ]);
    }

    public function show_podcast_detail (Request $request, $id)
    {
        // Show podcast details
        $podcast = Podcast::with('comments')->find($id);

        if ($podcast) {
            return response()->json([
                'status' => 1,
                'message' => 'Podcast details fetched.',
                'data' => $podcast
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Podcast not found.',
                'data' => null
            ]);
        }
    }
}
