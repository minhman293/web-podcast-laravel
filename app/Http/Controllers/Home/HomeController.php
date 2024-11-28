<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcaster;
use App\Models\Podcast;
use App\Models\Comment;
use App\Models\Category;

class HomeController extends Controller
{
    public function index() {
        $podcasters = Podcaster::withCount('podcasts')->get();
        $podcasts = Podcast::all();
        return view('index', compact('podcasters', 'podcasts'));
    }
}
