<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PodcasterFollower;

class PodcasterFollowerController extends Controller
{
    public function follow(Request $request)
    {
        $podcasterId = $request->input('podcaster_id');
        $followerId = Auth::id();

        // Kiểm tra xem người dùng đã follow podcaster chưa
        $existingFollow = PodcasterFollower::where('podcaster_id', $podcasterId)
                                           ->where('follower_id', $followerId)
                                           ->first();

        if (!$existingFollow) {
            // Tạo mới dòng dữ liệu trong bảng podcaster_followers
            PodcasterFollower::create([
                'podcaster_id' => $podcasterId,
                'follower_id' => $followerId,
            ]);

            return response()->json(['status' => 1, 'message' => 'Followed successfully.']);
        }

        return response()->json(['status' => 0, 'message' => 'Already followed.']);
    }

    public function unfollow(Request $request)
    {
        $podcasterId = $request->input('podcaster_id');
        $followerId = Auth::id();

        // Xóa dòng dữ liệu trong bảng podcaster_followers
        PodcasterFollower::where('podcaster_id', $podcasterId)
                         ->where('follower_id', $followerId)
                         ->delete();

        return response()->json(['status' => 1, 'message' => 'Unfollowed successfully.']);
    }
}
