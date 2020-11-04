<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supplement;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the supplement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplement  $supplement
     * @return mixed
     */
    public function view(User $user, Supplement $supplement)
    {
        //
    }

    /**
     * Determine whether the user can create supplements.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // On utilise plutot Gate::define(create-supplements, f...)
    }

    /**
     * Determine whether the user can update the supplement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplement  $supplement
     * @return mixed
     */
    public function update(User $user, Supplement $supplement)
    {
        return $user->restaurant->id == $supplement->restaurant->id;
    }

    /**
     * Determine whether the user can delete the supplement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplement  $supplement
     * @return mixed
     */
    public function delete(User $user, Supplement $supplement)
    {
        return $user->restaurant->id == $supplement->restaurant->id;
    }

    /**
     * Determine whether the user can restore the supplement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplement  $supplement
     * @return mixed
     */
    public function restore(User $user, Supplement $supplement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the supplement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplement  $supplement
     * @return mixed
     */
    public function forceDelete(User $user, Supplement $supplement)
    {
        return $user->restaurant->id == $supplement->restaurant->id;
    }
}
