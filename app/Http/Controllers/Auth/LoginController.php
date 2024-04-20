<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try{
            $user = User::where('email', $request->email)->first();    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'Email or Password not correct'], 401);
        }
    
        $token = $user->createToken($user->name);
        return response([
            'message' => 'Hello ' .$user->name,
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 201);
        } catch(\Exception $e){
            return response(['message' => $e->getMessage()], 401);

        }
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            $request->user()->tokens()->delete();
        }

        return response(['message' => 'User logged out successfully','success'=>true],200);
    }


    public function loadedUsers(){
        try{
        $user=Auth::user();
    
    return response([
        'message' => 'Hello ' .$user->name,
        'user' => $user,
        'role'=>$user->role
    ], 201);
    } catch(\Exception $e){
        return response(['message' => $e->getMessage()], 401);

    }
}
}
