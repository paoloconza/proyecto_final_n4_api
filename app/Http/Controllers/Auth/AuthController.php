<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

       try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
       } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage()]);
       }



        // {
        //     try {
        //         $user = User::create([
        //             'name' => $request->name,
        //             'email' => $request->email,
        //             'password' => bcrypt($request->password)
        //         ]);

        //         $token = JWTAuth::fromUser($user);
        //         return response()->json(compact('user', 'token'), 201);
        //     } catch (\Exception $e) {
        //         return response()->json(['error' => 'Internal Server Error'], 500);
        //         // return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);

        //     }
        // }

        // return response()->json([
        //     'message' => 'Register Success'
        // ], 200);
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();
        return response()->json(compact('user', 'token'), 200);
    }
}
