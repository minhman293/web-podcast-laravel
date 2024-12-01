<?php

namespace App\Services;

use App\Models\Podcaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Exception;

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
            DB::beginTransaction();

            $podcaster = $this->podcaster->create($data);
            Log::info('Podcaster created: ' . $podcaster->id);

            $podcaster->sendEmailVerificationNotification();
            Log::info('Email verification sent to: ' . $podcaster->email);


            DB::commit();

            return $podcaster;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: ' . $e->getMessage());
            return null;
        }
    }

    public function login($data)
    {
        $podcaster = $this->podcaster->where('email', $data['email'])->first();

        $isPasswordValid = Hash::check($data['password'], $podcaster->password);

        if (!$podcaster || !$isPasswordValid) {
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

    public function loginSocial($params, string $provider)
    {
        try {
            return Podcaster::firstOrCreate(
                [$provider . '_id' => $params->id],
                [
                    'name' => $params->name,
                    'email' => $params->email,
                    'password' => 'SOCIAL_AUTHENTICATION',
                    'image' => $params->avatar,
                    $provider . '_id' => $params->id,
                ]
            );
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
    }
}
