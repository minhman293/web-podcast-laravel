<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Podcaster;
use Auth;

class AuthController extends Controller
{
    // --------------------------------
    // WEB --------------------------------

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $podcaster = Podcaster::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $response = [];
        $response["token"] = $podcaster->createToken("podcaster")->plainTextToken;
        $response["name"] = $podcaster->name;
        $response["email"] = $podcaster->email;

        // Lưu thông tin người dùng và token vào session
        session([
            'podcaster_id' => $podcaster->id,
            'name' => $podcaster->name,
            'email' => $podcaster->email,
            'token' => $response["token"]
        ]);

        return redirect('/login-register')->with('success', 'Podcaster registered successfully. Now you can login.')->with('session_data', session()->all());
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $podcaster = Auth::user();
            
            // Lưu thông tin người dùng và token vào session
            session([
                'podcaster_id' => $podcaster->id,
                'name' => $podcaster->name,
                'email' => $podcaster->email,
                'token' => $podcaster->createToken("podcaster")->plainTextToken
            ]);

            return redirect('/')->with('success', 'Podcaster login successfully.')->with('session_data', session()->all());
        }

        return redirect()->back()->with('error', 'Incorrect email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }

    // --------------------------------
    // API --------------------------------
    public function register_api(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ]);
        }

        $podcaster = Podcaster::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $response = [];
        $response["token"] = $podcaster->createToken("podcaster")->plainTextToken;
        $response["name"] = $podcaster->name;
        $response["email"] = $podcaster->email;
        
        return response()->json([
            "status" => 1,
            "message" => "Podcaster registered successfully. Now you can login.",
            "data" => $response
        ]);
    }

    public function login_api(Request $request) 
    {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $podcaster = Auth::user();
            
            $response = [];
            $response["token"] = $podcaster->createToken("podcaster")->plainTextToken;
            $response["id"] = $podcaster->id;
            $response["name"] = $podcaster->name;
            $response["email"] = $podcaster->email;
            $response["image"] = $podcaster->image;
            $response["google_id"] = $podcaster->google_id;
            $response["facebook_id"] = $podcaster->facebook_id;
            $response["created_at"] = $podcaster->created_at;
            $response["updated_at"] = $podcaster->updated_at;

            session([
                'podcaster_id' => $podcaster->id,
                'name' => $podcaster->name,
                'email' => $podcaster->email,
                'token' => $response["token"]
            ]);

            return response()->json([
                "status" => 1,
                "message" => "Podcaster login successfully.",
                "data" => $response
            ]);
        }

        return response()->json([
            "status" => 0,
            "message" => "Uncorrect email or password.",
            "data" => null
        ]);
    }

    public function checkSession(Request $request)
    {
        if (session()->has('id')) {
            return response()->json([
                'status' => 1,
                'message' => 'Session exists',
                'data' => session()->all()
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'No session found'
            ]);
        }
    }
}
