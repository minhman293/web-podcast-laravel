<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\NotificationRequest;
use App\Models\Notification;
use App\Models\PodcasterFollower;
use App\Services\Notification\NotificationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    private NotificationService $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function store(NotificationRequest $notificationRequest)
    {
        try {
            $notificationType = $notificationRequest->get('type');
            $request = $notificationRequest->validated();
            if($notificationType == 'COMMENT') {
                $isSuccess = $this->notificationService->create($request);
            } else if ($notificationType == 'POST_NEW_PODCAST') {
                $followerIds = PodcasterFollower::where('podcaster_id', $request['sender_id'])->get('follower_id')->pluck('follower_id');
                foreach ($followerIds as $followerId) {
                    $notificationRequest['reciver_id'] = $followerId;
                    $this->notificationService->create($notificationRequest);
                }
            }
            return response()->json([
                'is_success' => $isSuccess
            ], $isSuccess ? 200 : 500);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'is_success' => false,
               'message' => 'Error creating notification'
            ], 500);
        }
    }

    public function updateStatus()
    {
        try {
            $is_success = $this->notificationService->updateStatus(Auth::id());
            return response()->json([
                'is_success' => $is_success,
                // 'user_id' => Auth::id(),
            ]);
        } catch (\Exception $e) {
            dd($e);
            Log::error($e);
            return response()->json([
                'is_success' => $e,
            ], 500);
        }
    }
}
