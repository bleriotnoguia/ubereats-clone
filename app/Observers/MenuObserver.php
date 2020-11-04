<?php

namespace App\Observers;

use App\Models\Menu;
use App\Models\Item;

class MenuObserver
{
    /**
     * Handle the menu "created" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        //
    }

    /**
     * Handle the menu "updated" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        //
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        Item::where('menu_id', $menu->id)->update(['menu_id' => null]);
    }

    /**
     * Handle the menu "restored" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function restored(Menu $menu)
    {
        //
    }

    /**
     * Handle the menu "force deleted" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function forceDeleted(Menu $menu)
    {
        //
    }
}
