<?php

namespace App\Policies;

use App\Shake;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShakePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any shakes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)//?User allows it to be null also
    {
        return true;
    }

    /**
     * Determine whether the user can view the shake.
     *
     * @param  \App\User  $user
     * @param  \App\Shake  $shake
     * @return mixed
     */
    public function view(?User $user, Shake $shake)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create shakes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create shake');
    }

    /**
     * Determine whether the user can update the shake.
     *
     * @param  \App\User  $user
     * @param  \App\Shake  $shake
     * @return mixed
     */
    public function update(User $user, Shake $shake)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the shake.
     *
     * @param  \App\User  $user
     * @param  \App\Shake  $shake
     * @return mixed
     */
    public function delete(User $user, Shake $shake)
    {
        if($user->id === $shake->user->id)
            return $user->can('delete others shake');
        return $user->can('delete shake');
    }

    /**
     * Determine whether the user can restore the shake.
     *
     * @param  \App\User  $user
     * @param  \App\Shake  $shake
     * @return mixed
     */
    public function restore(User $user, Shake $shake)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the shake.
     *
     * @param  \App\User  $user
     * @param  \App\Shake  $shake
     * @return mixed
     */
    public function forceDelete(User $user, Shake $shake)
    {
        //
        return true;
    }
}
