<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notation;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the notation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notation  $notation
     * @return mixed
     */
    public function view(User $user, Notation $notation)
    {
        //
    }

    /**
     * Determine whether the user can create notations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the notation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notation  $notation
     * @return mixed
     */
    public function update(User $user, Notation $notation)
    {
        return $user->id == $notation->user_id;
    }

    /**
     * Determine whether the user can delete the notation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notation  $notation
     * @return mixed
     */
    public function delete(User $user, Notation $notation)
    {
        return $user->id == $notation->user_id;
    }

    /**
     * Determine whether the user can restore the notation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notation  $notation
     * @return mixed
     */
    public function restore(User $user, Notation $notation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the notation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notation  $notation
     * @return mixed
     */
    public function forceDelete(User $user, Notation $notation)
    {
        //
    }
}
