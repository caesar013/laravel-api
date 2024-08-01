<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->save();

        $u = new UserResource($user);

        $token = $user->createToken($request->validated()['email']);

        return [
            'user' => $u,
            'token' => $token->plainTextToken,
        ];
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token,
        ];
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
