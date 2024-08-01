<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', ['except' => ['index', 'show']])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return UserResource::collection(User::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        # code...
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        # code...
        Gate::authorize('modify', $user);

        $user->update($request->validated());
        $user->save();

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        # code...
        Gate::authorize('modify', $user);
        
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
