<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Models\Podcaster as PodcasterModel;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authService;

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

        return redirect()->route('get_login')->with('error', $loginResult['message']);
    }

    public function getRegister() 
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $registerRequest)
    {
        $validRegister = $registerRequest->validated();

        $registerResult = $this->authService->register($validRegister);

        if($registerResult instanceof PodcasterModel) {
            return redirect()->route('get_login')->with('success', 'Register successfully');
        }

        return redirect()->route('get_register')->with('error', 'Register failed');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('get_login');
    }
}
