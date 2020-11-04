<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\API\V1', 'middleware'=>'cors'], function($api){

        $api->get('terms', 'SettingController@getTerms');
        $api->get('privacy', 'SettingController@getPrivacy');

        $api->get('cuisines', 'CuisineController@index');
        $api->get('settings', 'SettingController@list');
    
        $api->get('restaurants', 'RestaurantController@index');
        $api->get('restaurants/{restaurant}', 'RestaurantController@show');
        $api->get('cuisines/{cuisine}/restaurants', 'RestaurantController@showRestaurantsByCuisine');
        $api->get('restaurants/{restaurant}/menus', 'RestaurantController@getMenus');
        $api->get('restaurants/{restaurant}/categories', 'RestaurantController@getCategories');
        
        $api->get('items', 'ItemController@index');
        $api->get('items/{item}', 'ItemController@show');
        $api->get('restaurants/{restaurant}/items', 'ItemController@showItemsByRestaurant');
        $api->get('categories/{category}/items', 'ItemController@showItemsByCategory');
        $api->get('menus/{menu}/items', 'ItemController@showItemsByMenu'); 
        $api->get('cuisines/{cuisine}/items', 'ItemController@showItemsByCuisine');
        $api->post('filter/items', 'ItemController@showItems');
    
        $api->get('payment-methods', 'SettingController@getPaymentMethods');
    
        $api->get('distances/restaurants', 'RestaurantController@showRestaurantsByDistance');

        $api->post('checkout', 'OrderController@checkout');

        $api->group(['middleware'=>['auth:api','bindings','unblocked']], function($api){
            $api->resource('orders', 'OrderController');

            $api->get('status/orders', 'OrderController@orderByStatus');
    
            $api->get('status/order/{order}', 'OrderController@orderStatus');
            
            $api->resource('metas', 'MetaController');
            
            $api->resource('notations', 'NotationController');
            $api->get('notations/{type}/criteria', 'NotationController@criteria');
            
            $api->post('file/upload', 'FileController@upload');
            $api->post('file/profile', 'FileController@saveProfileImg');
    
            $api->get('promocodes/{code}/check', 'OrderController@checkCode');
    
            $api->post('stripe', 'StripePaymentController@postStripePayment')->name('stripe.payment');

            $api->get('trackings/position', 'ShippingController@getOrderPosition');

            $api->get('search/shippers', 'Auth\UserController@searchShippers');

            $api->group(['middleware'=>['role:shipper']], function($api){
                $api->resource('shippings', 'ShippingController');
                $api->get('status/{status}/shippings', 'ShippingController@shippingByStatus');

                $api->get('status/shippings', 'ShippingController@shippingByStatus');

                $api->post('toggle/availability', 'Auth\UserController@toggleAvailability');

                $api->post('service/zone', 'Auth\UserController@updateGmapAddress');

                $api->post('trackings/position', 'ShippingController@updatePosition');

                $api->post('take/shipping/{shipping}', 'ShippingController@takeShipping');

                $api->get('wallet', 'Auth\UserController@wallet');

                $api->get('payouts', 'Auth\UserController@payout');
            });

            $api->group(['prefix'=>'shop', 'namespace'=>'Shop', 'middleware'=>['role:shop-admin']], function($api){
                $api->get('orders', 'OrderController@index');
                $api->get('orders/{order}', 'OrderController@show');
                $api->put('orders/{order}', 'OrderController@update');
                $api->get('total/status/orders', 'OrderController@getOrdersTotalByStatus');

                $api->get('orders/export/{order}','OrderController@export_pdf');

                $api->get('shippings', 'ShippingController@index');
                $api->put('shippings/{shipping}', 'ShippingController@update');

                $api->post('toggle/availability','ShopController@toggleShopAvailability');

            });
        });
    
    });

    $api->group(['prefix'=>'v1/auth','namespace'=>'App\Http\Controllers\API\V1\Auth', 'middleware'=>'cors'], function($api){

        $api->group(['middleware'=>'api','prefix'=>'password'], function($api){
            $api->post('create', 'ResetPasswordController@create');
            $api->get('find/{token}', 'ResetPasswordController@find');
            $api->post('reset', 'ResetPasswordController@reset');
        });

        $api->post('register', 'UserController@register');
        $api->post('login', 'UserController@login');
        $api->get('signup/activate/{token}', 'UserController@signupActivate');

        $api->group(['middleware'=>['auth:api','unblocked']], function($api){
            $api->get('logout', 'UserController@logout');
            $api->put('update', 'UserController@update');
            $api->delete('delete', 'UserController@destroy');
            $api->get('user', 'UserController@details');
            $api->post('onesignal', 'UserController@onesignal');
        });
    });
});