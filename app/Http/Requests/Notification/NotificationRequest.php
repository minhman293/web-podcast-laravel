<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sender_id'  => ['required'],
            'receiver_id'  => ['required'],
            'podcast_id'  => ['required'],
            'content'  => ['required'],
            'is_seen'  => ['required'],
        ];
    }
}
