<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function modify(User $user, User $model): Response
    {
        //
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You do not own this user');
    }
}
