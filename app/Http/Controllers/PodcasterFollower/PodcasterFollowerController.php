<?php

namespace App\Http\Controllers\PodcasterFollower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PodcasterFollower;
use App\Models\Podcaster;
use Illuminate\Support\Facades\Auth;

class PodcasterFollowerController extends Controller
{

    public function subscribe(Request $request, Podcaster $podcaster)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in to subscribe.');
        }

        if ($podcaster->id == $user->id) {
            return redirect()->route('podcasters.index', $podcaster->id)->with('error', 'You cannot subscribe to your own profile.');
        }

        $follower = PodcasterFollower::withTrashed()->where('podcaster_id', $podcaster->id)
                                                ->where('follower_id', $user->id)
                                                ->update(['deleted_at' => null]);

        if ($follower) {
            // PodcasterFollower::withTrashed()->where('id', Auth::id())->restore();
        } else {
            // Tạo bản ghi mới nếu chưa tồn tại
            PodcasterFollower::create([
                'podcaster_id' => $podcaster->id,
                'follower_id' => $user->id,
            ]);
        }

        PodcasterFollower::updateOrCreate([
            'podcaster_id' => $podcaster->id,
            'follower_id' => $user->id
        ]);

        return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'Successfully subscribed.');
    }

    public function unsubscribe(Request $request, Podcaster $podcaster)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in to unsubscribe.');
        }

        if ($podcaster->id == $user->id) {
            return redirect()->route('podcasters.index', $podcaster->id)->with('error', 'You cannot unsubscribe from your own profile.');
        }

        // Xóa mềm bản ghi
        PodcasterFollower::where([
            'podcaster_id' => $podcaster->id,
            'follower_id' => $user->id,
        ])->delete();

        return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'Successfully unsubscribed.');
    }

    public function follow(Request $request)
    {
        $podcasterId = $request->input('podcaster_id');
        $followerId = Auth::id();

        // Kiểm tra xem người dùng đã follow podcaster chưa
        $existingFollow = PodcasterFollower::withTrashed()->where('podcaster_id', $podcasterId)
                                                        ->where('follower_id', $followerId)
                                                        ->update(['deleted_at' => null]);

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
