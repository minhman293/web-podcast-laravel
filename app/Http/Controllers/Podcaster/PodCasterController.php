<?php

namespace App\Http\Controllers\Podcaster;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\Podcaster;
use App\Models\PodcasterFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PodcasterController extends Controller
{
    public function index(Podcaster $podcaster)
    {
        $user = Auth::user();
        $podcasts = Podcast::where('podcaster_id', $podcaster->id)->get();
        $is_owner = $podcaster->id == Auth::id();

        if (!$podcaster->image) {
            $podcaster->image = 'default_avatar_profile_icon.jpg';
        }

        $followersCount = PodcasterFollower::where('podcaster_id', $podcaster->id)->count();
        $isSubscribed = $user ? PodcasterFollower::where('podcaster_id', $podcaster->id)->where('follower_id', $user->id)->exists() : false;

        return view('podcaster.profile', [
            'podcasts' => $podcasts,
            'podcaster' => $podcaster,
            'is_owner' => $is_owner,
            'followersCount' => $followersCount,
            'isSubscribed' => $isSubscribed
        ]);
    }

    public function edit(Podcaster $podcaster)
    {
        $is_owner = $podcaster->id == Auth::id();

        if (!$podcaster->image) {
            $podcaster->image = 'default_avatar_profile_icon.jpg';
        }

        return view('podcaster.update_profile', [
            'podcaster' => $podcaster,
            'is_owner' => $is_owner
        ]);
    }

    public function update(Request $updateRequest, Podcaster $podcaster)
    {
        $validatedData = $updateRequest->validate([
            'channelName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($updateRequest->hasFile('image')) {
            $image = $updateRequest->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images'), $imageName);

            if ($podcaster->image && file_exists(public_path('assets/images/' . $podcaster->image))) {
                unlink(public_path('assets/images/' . $podcaster->image));
            }

            $podcaster->image = $imageName;
        }

        // Cập nhật tên kênh
        $podcaster->name = $validatedData['channelName'];

        // Lưu các thay đổi vào cơ sở dữ liệu
        $podcaster->save();

        return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'Update success');
    }
}