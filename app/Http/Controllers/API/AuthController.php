<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
     
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->responseWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(RegisterRequest $request)
    {
    
        $user = new User();

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
 
        return response()->json([
           'success' => true
        ]);
    }

    public function logout(){
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);

        // if (Auth::check()) {
        //     Auth::user()->token()->revoke();
        //     return response()->json(['success' =>'Successfully logged out of application'],200);
        // }else{
        //     return response()->json(['error' =>'api.something_went_wrong'], 500);
        // }
    }
    public function responseWithToken($token)
    {
        $user = Auth::user();

        return response()->json([
            'data' =>[
                'succes' => true,
                'access_token' => $token,
                'user' => $user,
                'token_type' => 'bearer',
                'expires_in' => $this->guard()->factory()->getTTL() * 60,
            ]
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function refresh()
    {
        return $this->responseWithToken($this->guard()->refresh());
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }
}
