<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest 
{
    public function rules() 
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:podcasters',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}