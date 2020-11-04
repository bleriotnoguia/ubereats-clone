<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can create items.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // On utilise plutot Gate::define(create-items, f...)
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return $user->restaurant->id == $item->restaurant->id;
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        return $user->restaurant->id == $item->restaurant->id;
    }

    /**
     * Determine whether the user can restore the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function restore(User $user, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function forceDelete(User $user, Item $item)
    {
        return $user->restaurant->id == $item->restaurant->id;
    }
}
