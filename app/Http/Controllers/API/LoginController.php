<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        // $validator = $request->validate([
        //     'email'     => 'required',
        //     'password'  => 'required'
        // ]);
        $credentials = $request->only(['email','password']);
        if (auth()->attempt($credentials)) {
            return response()->json([
                "msg" => "sukses",
                "user" => Auth::user()->name
            ]);
            // return redirect()->route('home');
        }
        else{
            return response()->json([
                "msg" => "not found"
            ]);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }
}
