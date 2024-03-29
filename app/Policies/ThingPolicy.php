<?php

namespace App\Policies;

use App\Models\Thing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access the model.
     *
     * ThingがUserに属しているかチェックする
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function confirmThingPermission(User $user, Thing $thing)
    {
        $result = ((int)$user->id === (int)$thing->user_id);
        return $result;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Thing $thing)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Thing $thing)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Thing $thing)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Thing $thing)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Thing $thing)
    {
        //
    }
}
