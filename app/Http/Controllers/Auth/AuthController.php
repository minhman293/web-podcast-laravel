<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Models\Podcaster;
use App\Services\AuthType;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $loginRequest)
    {        
        $validLogin = $loginRequest->validated();

        $loginResult = $this->authService->login($validLogin);

        if($loginResult['status']) {
            Auth::loginUsingId($loginResult['podcaster']->id);
            return redirect()->route('index')->with('success', 'login successfully');
        }

        return redirect()->route('get_login')->with('error', 'login failed');
    }

    public function getRegister() 
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $registerRequest)
    {
        $validRegister = $registerRequest->validated();
        Log::info('Register request validated: ' . json_encode($validRegister));

        $registerResult = $this->authService->register($validRegister);
        Log::info('Register result: ' . json_encode($registerResult));

        if($registerResult instanceof Podcaster) {
            return redirect()->route('verification.notice')->with('success', 'Please verify your email address.');
        }

        return redirect()->route('get_register')->with('error', 'Registration failed');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('get_login');
    }

    private function validateSocialProvider(string $provider)
    {
        return in_array($provider, ['google'], true);
    }

    public function redirectSocial(string $provider)
    {
        if(!$this->validateSocialProvider($provider)) {
            abort(404); 
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(string $provider)
    {
        try {
            if(!$this->validateSocialProvider($provider)) {
                abort(404); 
            }
            $user = $this->authService->loginSocial(
                Socialite::driver($provider)->user(), 
                $provider);

            if ($user) {
                Auth::loginUsingId($user->id);
                return redirect()->route('index');
            }
            return redirect()->route('get_login')->with('error', 'Login failed');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('get_login')->with('error', 'Login failed');
        }
    }
}
