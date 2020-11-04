<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function view(User $user, Restaurant $restaurant)
    {
        return $restaurant->user_id == $user->id;
    }

    /**
     * Determine whether the user can create restaurants.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // check if user have 'shop-admin' permission and if he does have restaurant yet'
        return $user->isShopAdmin() && !$user->restaurant;
    }

    /**
     * Determine whether the user can update the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function update(User $user, Restaurant $restaurant)
    {
        return $restaurant->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function delete(User $user, Restaurant $restaurant)
    {
        return $restaurant->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function restore(User $user, Restaurant $restaurant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function forceDelete(User $user, Restaurant $restaurant)
    {
        return $restaurant->user_id == $user->id;
    }

    /**
     * Determine whether the user can toggle to the restaurant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $restaurant
     * @return mixed
     */
    public function toggle(User $user, Restaurant $restaurant){
        return $restaurant->user_id == $user->id;
    }
}
