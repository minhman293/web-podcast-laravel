<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:podcasters,email'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Email not found',
        ];
    }
}
