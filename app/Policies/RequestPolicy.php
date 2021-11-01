<?php

namespace App\Policies;

use App\Models\{
    User,
    Request
};
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function requestUser(User $user, Request $request){
        return $user->id == $request->user_id;
    }
}
