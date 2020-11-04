<?php

namespace App\Observers;

use App\Notifications\UserRegistered;
use App\Notifications\SignupActivate;
use App\Models\User;
use Storage;
use Avatar;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $image = Avatar::create(ucwords($user->full_name))->toBase64();
        $image = str_replace('data:image/png;base64,', '', $image);
        Storage::put('public/users/'.$user->id.'/avatar.png', base64_decode($image));
        
        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();
        if($super_admin){
            // Notifier le super-admin de la création d'un nouvel utilisateur
            $super_admin->notify((new UserRegistered($user))->delay(now()->addSeconds(10)));
        }
        if($user->isCustomer()){
            // On envoie l'email de confirmation de compte a cet utilisateur
            $user->notify((new SignupActivate($user))->delay(now()->addSeconds(10)));
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $image = Avatar::create(ucwords($user->full_name))->toBase64();
        $image = str_replace('data:image/png;base64,', '', $image);
        Storage::put('public/users/'.$user->id.'/avatar.png', base64_decode($image));
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        if($user->address){
            $user->address->delete();
        }
        $user->orders()->delete();
        if($user->restaurant){
            $user->restaurant->delete();
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        if($user->address){
            $user->address->restore();
        }
        $user->orders()->restore();
        if($user->restaurant){
            $user->restaurant->restore();
        }
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        if($user->address){
            $user->address->forceDelete();
        }
        $user->orders()->forceDelete();
        if($user->restaurant){
            $user->restaurant->forceDelete();
        }
        $user->notifications()->delete();
        $user->roles()->detach();
    }
}
