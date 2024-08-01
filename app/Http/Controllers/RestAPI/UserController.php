<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        $user = new User();
        // fill the user with the validated data except the password
        $user->fill($request->validated());
        $user->save();

        if ($user) {
            # code...
            return new UserResource($user);
        }
        return response()->json(['message' => 'User creation failed'], 500);
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
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
