<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Function logins
     */
    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'Wrong username or password !'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'messae' => 'Login Success !',
            'user' => auth()->user(),
            'token' => "Bearer ".$token
        ], 200);
    }
}
