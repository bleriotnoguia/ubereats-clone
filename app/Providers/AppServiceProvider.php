<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Invoice;
use App\Models\Restaurant;
use App\Observers\ItemObserver;
use App\Observers\MenuObserver;
use App\Observers\OrderObserver;
use App\Observers\ShippingObserver;
use App\Observers\InvoiceObserver;
use App\Observers\RestaurantObserver;
use Illuminate\Support\Facades\Auth;
use App\Observers\UserObserver;
use OnboardFacade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function($view){
            if(Auth::check()){
                if(Auth::user()->isShopAdmin()){
                    $_restaurant = Auth::user()->restaurant;
                    OnboardFacade::addStep(__('Create your shop'))
                    ->link('/restaurants/create')
                    ->cta(__('Create shop'))
                    ->completeIf(function (User $user) use($_restaurant){
                        return $_restaurant;
                    });
                    if(isset($_restaurant)){
                        if(!$_restaurant->is_merchant){
                            OnboardFacade::addStep(__('Create your first menu'))
                            ->link('/menus/create/'.$_restaurant->id)
                            ->cta(__('Create menu'))
                            ->completeIf(function (User $user) use($_restaurant) {
                                return $_restaurant->menus->count() > 0;
                            });
                        }
                        OnboardFacade::addStep(__('Create your first category'))
                        ->link('/categories/create/'.$_restaurant->id)
                        ->cta(__('Create category'))
                        ->completeIf(function (User $user) use($_restaurant) {
                            return $_restaurant->categories->count() > 0;
                        });
                        OnboardFacade::addStep(__('Create your first item'))
                        ->link('/items/create/'.$_restaurant->id)
                        ->cta(__('Create item'))
                        ->completeIf(function (User $user) use($_restaurant){
                            return $_restaurant->items->count() > 0;
                        });
                        // if(!$_restaurant->is_merchant){
                        //     OnboardFacade::addStep(__('Create your first supplement'))
                        //     ->link('/supplements/create/'.$_restaurant->id)
                        //     ->cta(__('Create supplement'))
                        //     ->completeIf(function (User $user) use($_restaurant){
                        //         return $_restaurant->supplements->count() > 0;
                        //     });
                        // }
                    }
                }
            }
        });
        
        View::composer([
            'layouts.partials.sidebar', 
            'layouts.partials.controlsidebar', 
            'menus.index',
            'categories.index', 
            'invoices.*', 
            'payments.*', 
            'items.*', 
            'orders.*', 
            'customers.*', 
            'promocodes.*', 
            'restaurants.*', 
            'shippings.*', 
            'shippers.*', 
            'supplements.*', 
            'users.*', 
            'payouts.*', 
            'dashboard', 
            'contact', 
            'documentation', 
            'settings.site', 
            'pdf.*'
        ], function ($view) {
            $formatter = new \NumberFormatter(env('LANGUAGE_CODE').'@currency='.env('CURRENCY_CODE'), \NumberFormatter::CURRENCY);
            if(Auth::check()){
                if(Auth::user()->isSuperAdmin()){
                    $restaurants = Restaurant::latest()->get();
                    $view->with(compact('restaurants'));
                }elseif(Auth::user()->isShopAdmin()){
                    $_restaurant = Auth::user()->restaurant;
                    if(isset($_restaurant)){
                        $view->with(compact('_restaurant'));
                    }
                }
                $view->with(compact('formatter'));
            }
        });

        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Item::observe(ItemObserver::class);
        Menu::observe(MenuObserver::class);
        Order::observe(OrderObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Shipping::observe(ShippingObserver::class);
        Restaurant::observe(RestaurantObserver::class);
    }
}
