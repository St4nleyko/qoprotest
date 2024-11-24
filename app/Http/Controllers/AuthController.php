<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function issueToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } else {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }


        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function revokeToken(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return response()->json(['message' => 'Token revoked successfully']);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Invalid or missing token'], 400);
        }
    }

    public function issueTokenView(){
        return view('jwt-tokens.issue-token');
    }

}
