<?php

namespace App\Services\Notification;

use App\Models\Notification;

use Illuminate\Support\Facades\Log;
class NotificationService
{
    // Thông báo podcast mới được tạo
    public function podcastCreated($podcaster, $podcast)
    {
        $followers = $podcaster->followers; // Lấy danh sách người theo dõi

        foreach ($followers as $follower) {
            Notification::create([
                // 'type' => 'created', // Phân loại là "podcast được tạo"
                'content' => "{$podcaster->name} đã tải lên: {$podcast->title}",
                'podcast_id' => $podcast->id,
                'podcaster_id' => $follower->follower_id, // Gửi đến người theo dõi
            ]);
        }
    }

    // Thông báo khi có bình luận
    public function podcastCommented($commenter, $podcast, $comment)
    {
        // Kiểm tra tồn tại của podcaster_id trong podcast
        if (!$podcast || !$podcast->podcaster_id) {
            Log::error("Podcast or Podcaster missing in notification");
            return;
        }
        Notification::create([
            // 'type' => 'commented', // Phân loại là "bình luận"
            'content' => "{$commenter->name} đã bình luận về {$podcast->title}: '{$comment->content}'",
            'podcast_id' => $podcast->id,
            'podcaster_id' => $podcast->podcaster_id, // Gửi đến chủ sở hữu podcast
        ]);
    }
}
