<?php

namespace App\Services;

use App\Models\Podcaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $podcaster;

    public function __construct(Podcaster $podcaster)
    {
        $this->podcaster = $podcaster;
    }

    public function register($data)
    {
        try {
            $podcaster = $this->podcaster->create($data);

            return $podcaster;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function login($data)
    {
        $podcaster = $this->podcaster->where('email', $data['email'])->first();

        // debug
        // if (!$podcaster) {
        //     return [
        //         'status' => false,
        //         'message' => 'Email not found'
        //     ];
        // }

        $isPasswordValid = Hash::check($data['password'], $podcaster->password);

        // debug
        // if (!$isPasswordValid) {
        //     return [
        //         'status' => false,
        //         'message' => 'Invalid password'
        //     ];
        // }

        if(!$podcaster || !$isPasswordValid) {
            return [
                'status' => false,
                'message' => 'Invalid email or password'
            ];
        }

        return [
            'status' => true,
            'message' => 'Login successfully',
            'podcaster' => $podcaster
        ];
    }

    public function logout()
    {
        Auth::logout();

        return true;
    }
}