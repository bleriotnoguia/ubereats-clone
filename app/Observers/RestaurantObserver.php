<?php

namespace App\Observers;

use App\Notifications\RestaurantCreated;
use App\Notifications\RestaurantDeleted;
use App\Models\Restaurant;
use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Notification;
use Auth;

class RestaurantObserver
{
    /**
     * Handle the restaurant "created" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function created(Restaurant $restaurant)
    {
        if(request()->get('programmes')){
            $programmes = json_decode(request()->get('programmes'));
            foreach ($programmes as $dayProgramme) {
                $dayProgramme->restaurant_id = $restaurant->id;
                $restaurant->programmes()->create((array)$dayProgramme);
            }
        }

        if(request()->get('cuisines')){
            $restaurant->cuisines()->sync(request()->get('cuisines'));
        }

        if(request()->get('gmap_address')){
            $restaurant->address()->create([
                'description' => request()->get('address_description'),
                'gmap_address' => json_decode(request()->get('gmap_address'))
            ]);
        }
        
        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();
        Notification::send(
                    collect([
                    $restaurant->user, 
                    $super_admin]), 
                    (new RestaurantCreated($restaurant))->onConnection('database')
                            ->onQueue('default')
                            ->delay(10)
                );
    }

    /**
     * Handle the restaurant "updating" event.
     * 
     * @param \App\Models\Restaurant $restaurant
     * @return void
     */
    public function updating(Restaurant $restaurant){
        // 
    }

    /**
     * Handle the restaurant "updated" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function updated(Restaurant $restaurant)
    {
        if(request()->get('programmes') !== null){
            $array_objs = json_decode(request()->get('programmes'));
            foreach($array_objs as $day_obj){
                $programmes[] = (array)$day_obj;
            }
            $array_ids = array_map(function($value){
                return $value['id'];
            }, $programmes);
            $restaurant->programmes()->whereIn('id', array_diff($restaurant->programmes->pluck('id')->toArray(), $array_ids))->delete();
            foreach ($programmes as $dayProgramme) {
                if(isset($dayProgramme['id']) && $dayProgramme['id'] != "" ){
                    $restaurant->programmes()->where('id',$dayProgramme['id'])->update($dayProgramme);
                }else{
                    $restaurant->programmes()->create($dayProgramme);
                }
            }
        }
    }

    public function deleting(Restaurant $restaurant)
    {
        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();
        Notification::send(collect([$restaurant->user, $super_admin]), new RestaurantDeleted($restaurant));
    }

    /**
     * Handle the restaurant "deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function deleted(Restaurant $restaurant)
    {
        if($restaurant->address){
            $restaurant->address->delete();
        }
        $restaurant->orders()->delete();
        $restaurant->items()->delete();
        $restaurant->menus()->delete();
        $restaurant->categories()->delete();
        $restaurant->supplements()->delete();
        // $restaurant->user->delete();
    }

    /**
     * Handle the restaurant "restored" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function restored(Restaurant $restaurant)
    {
        if($restaurant->address){
            $restaurant->address->restore();
        }
        $restaurant->orders()->restore();
        $restaurant->items()->restore();
        $restaurant->menus()->restore();
        $restaurant->categories()->restore();
        $restaurant->supplements()->restore();
        // $restaurant->user->restore();
    }

    /**
     * Handle the restaurant "force deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function forceDeleted(Restaurant $restaurant)
    {
        if($restaurant->address){
            $restaurant->address->forceDelete();
        }
        $restaurant->orders()->forceDelete();
        $restaurant->items()->forceDelete();
        $restaurant->menus()->forceDelete();
        $restaurant->categories()->forceDelete();
        $restaurant->supplements()->forceDelete();
        // $restaurant->user->forceDelete();
        $restaurant->cuisines()->detach();
    }
}
