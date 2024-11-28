<?php

namespace App\Http\Controllers\Podcaster;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\Podcaster;
use App\Models\PodcasterFollower;
use App\Services\Podcasts\PodCastService;
use App\Services\Podcasters\PodcasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PodCasterController extends Controller
{
    private PodCastService $podcastService;

    private PodcasterService $podcasterService;

    public function __construct(PodcastService $podcastService, PodcasterService $podcasterService)
    {
        $this->podcastService = $podcastService;
        $this->podcasterService = $podcasterService;
    }

    public function index(Podcaster $podcaster)
    {
        Auth::loginUsingId(3);
        $user = Auth::user();

        $podcasts = $this->podcastService->getPodcastsByPodcasterId($podcaster->id);
        // $is_owner = $podcaster->id == 'ID_CUA_USER_DA_DANG_NHAP';  
        $is_owner = $podcaster->id == 1;

        if (!$podcaster->image) {
            $podcaster->image = 'default_avatar_profile_icon.jpg';
        }
        // $followersCount = $podcaster->followers()->count();
        $followersCount = PodcasterFollower::where('podcaster_id', $podcaster->id)->count();
        // dd($followersCount);

        $isSubscribed = PodcasterFollower::where('podcaster_id', $podcaster->id)    // truy vấn không bao gồm bản ghi xóa mềm
                                        ->where('follower_id', $user->id)
                                        ->exists();
        // $isSubscribed = PodcasterFollower::withTrashed()->where('podcaster_id', $podcaster->id) // truy vấn bao gồm bản ghi xóa mềm
        //                                                 ->where('follower_id', $user->id)
        //                                                 ->exists();

        // dd($podcaster,$user,$isSubscribed);

        return view(
            'podcasters.profile',
            [
                'podcasts' => $podcasts,
                'podcaster' => $podcaster,
                'is_owner' => $is_owner,
                'followersCount' => $followersCount,
                'isSubscribed' => $isSubscribed
            ]

        );
    }
    public function edit(Podcaster $podcaster)
    {
        $podcaster = $this->podcasterService->getPodcasterById($podcaster->id);
        // $is_owner = $podcaster->id == 'ID_CUA_USER_DA_DANG_NHAP';  
        $is_owner = $podcaster->id == 1;

        if (!$podcaster->image) {
            $podcaster->image = 'default_avatar_profile_icon.jpg';
        }

        return view(
            'podcasters.update_profile',
            [
                'podcaster' => $podcaster,
                'is_owner' => $is_owner
            ]
        );
    }
    public function update(Request $updateRequest, Podcaster $podcaster)
    {

        $validatedData = $updateRequest->validate([ // Xác thực 
            'channelName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($updateRequest->hasFile('image')) {
            $image = $updateRequest->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images'), $imageName);

            // Xóa ảnh cũ 
            if ($podcaster->image && file_exists(public_path('assets/images/' . $podcaster->image))) {
                unlink(public_path('assets/images/' . $podcaster->image));
            }
            $podcaster->name = $validatedData['channelName'];
            $validatedData['image'] = $imageName;
        }
        $result = $this->podcasterService->update($podcaster, $validatedData);

        if ($result) {
            return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'update success');
        }

        return redirect()->route('podcasters.index', $podcaster->id)->with('error', 'update failed');
    }


    public function subscribe(Request $request, Podcaster $podcaster)
{
    
    $user = auth()->user();

    if (!$user) {
        return ['error' => 'You need to log in to subscribe.'];
    }

    // Tìm bản ghi đã bị xóa mềm
    // $follower = PodcasterFollower::withTrashed()->where('podcaster_id', $podcaster->id)
    //                                             ->where('follower_id', $user->id)
    //                                             ->first();
    $follower = PodcasterFollower::withTrashed()->where('podcaster_id', $podcaster->id)
                                                ->where('follower_id', $user->id)
                                                ->update(['deleted_at' => null]);
    // dd($follower);
    if ($follower) {
        // Khôi phục bản ghi nếu đã bị xóa mềm:  PodcasterFollower::withTrashed()->where('id', $id)->restore();
        
        // dd($follower);
    } else {
        // Tạo bản ghi mới nếu chưa tồn tại
        PodcasterFollower::create([
            'podcaster_id' => $podcaster->id,
            'follower_id' => $user->id,
        ]);
    }

    return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'successfully subscribed.');
}

public function unsubscribe(Request $request, Podcaster $podcaster)
{
    
    $user = auth()->user();

    if (!$user) {
        return ['error' => 'You need to log in to unsubscribe.'];
    }

    // Xóa mềm bản ghi
    PodcasterFollower::where([
        'podcaster_id' => $podcaster->id,
        'follower_id' => $user->id,
    ])->delete();
    // xóa vĩnh viễn 1 bản khi xáo mềm :PodcasterFollower::withTrashed()->where('id', $id)->forceDelete();
    return redirect()->route('podcasters.index', $podcaster->id)->with('success', 'successfully unsubscribed.');
}


}
