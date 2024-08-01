<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    //
    public function __invoke(AvatarRequest $request, User $user)
    {
        Gate::authorize('modify', $user);
        if ($user) {
            # code...
            $isUpdate = false;
            if ($user->avatar) {
                # code...
                Storage::delete($user->avatar);
                $isUpdate = true;
            }
            $path = Storage::put('public/avatars', $request->validated()['avatar']);
            // $path = $request->file('avatar')->store('public/avatars');
            $user->avatar = $path;
            $user->save();

            if ($isUpdate) {
                # code...
                return response()->json(['message' => 'Avatar updated successfully'], 200);
            }
            return response()->json(['message' => 'Avatar uploaded successfully'], 200);
        }
    }
}
