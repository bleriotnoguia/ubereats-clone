<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use App\Models\Notation;
use App\Models\Shipping;
use App\Models\Supplement;
use App\Policies\UserPolicy;
use App\Policies\RestaurantPolicy;
use App\Policies\ItemPolicy;
use App\Policies\SupplementPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ShippingPolicy;
use App\Policies\NotationPolicy;
use App\Policies\MenuPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Restaurant::class => RestaurantPolicy::class,
        Item::class => ItemPolicy::class,
        Supplement::class => SupplementPolicy::class,
        Order::class => OrderPolicy::class,
        Notation::class => NotationPolicy::class,
        Shipping::class => ShippingPolicy::class,
        Category::class => CategoryPolicy::class,
        Menu::class => MenuPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user, $ability){
            if($user->isSuperAdmin()){
                return true;
            }
        });

        Gate::define('create-items', function ($user, $restaurant) {
            return $user->restaurant->id == $restaurant->id;
        });

        Gate::define('create-supplements', function ($user, $restaurant) {
            return $user->restaurant->id == $restaurant->id;
        });

        Gate::define('create-menus', function ($user, $restaurant) {
            return $user->restaurant->id == $restaurant->id;
        });

        Gate::define('create-categories', function ($user, $restaurant) {
            return $user->restaurant->id == $restaurant->id;
        });

        Gate::define('show-payout-transactions', function($user, $_user){
            return $user->id == $_user->id;
        });
        
        Passport::routes();
    }
}
