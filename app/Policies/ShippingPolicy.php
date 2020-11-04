<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Shipping;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any shippings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the shipping.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function view(User $user, Shipping $shipping)
    {
        return ($shipping->state == 'pending' &&  $shipping->order->state != 'pending') || ($shipping->user_id == $user->id);
    }

    /**
     * Determine whether the user can create shippings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the shipping.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function update(User $user, Shipping $shipping)
    {
        return $user->id == $shipping->user_id;
    }

    /**
     * Determine whether the user can delete the shipping.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function delete(User $user, Shipping $shipping)
    {
        //
    }

    /**
     * Determine whether the user can restore the shipping.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function restore(User $user, Shipping $shipping)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shipping.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function forceDelete(User $user, Shipping $shipping)
    {
        //
    }
}
