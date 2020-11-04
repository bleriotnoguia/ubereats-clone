<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NotationCreated;
use App\Models\Notation;
use App\Models\User;

class NotationObserver
{
    /**
     * Handle the notation "created" event.
     *
     * @param  \App\Models\Notation  $notation
     * @return void
     */
    public function created(Notation $notation)
    {
        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();
        Notification::send(collect([$notation->restaurant->user, $super_admin]), new NotationCreated($notation));
    }

    /**
     * Handle the notation "updated" event.
     *
     * @param  \App\Models\Notation  $notation
     * @return void
     */
    public function updated(Notation $notation)
    {
        //
    }

    /**
     * Handle the notation "deleted" event.
     *
     * @param  \App\Models\Notation  $notation
     * @return void
     */
    public function deleted(Notation $notation)
    {
        //
    }

    /**
     * Handle the notation "restored" event.
     *
     * @param  \App\Models\Notation  $notation
     * @return void
     */
    public function restored(Notation $notation)
    {
        //
    }

    /**
     * Handle the notation "force deleted" event.
     *
     * @param  \App\Models\Notation  $notation
     * @return void
     */
    public function forceDeleted(Notation $notation)
    {
        //
    }
}
