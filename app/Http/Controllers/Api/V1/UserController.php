<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $validatedData['password'] = bcrypt($request->password);
        
        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;
        $user->api_token = $accessToken;
        $user->save();
        return response(['api_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $user = auth()->user();
        $accessToken = $user->createToken('authToken')->accessToken;
        $user->api_token = $accessToken;
        $user->save();
        return response(['user' => $user]);

    }
}
