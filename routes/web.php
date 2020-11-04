<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/storage/{any}', function ($any) {
    $path = storage_path('app/public/'.$any);
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('any', '.*');

Route::get('/', 'HomeController@index');

Route::get('privacy', 'HomeController@privacy')->name('site.privacy');

Route::get('terms', 'HomeController@terms')->name('site.terms');

Route::get('lang/{locale}', 'HomeController@lang');

Auth::routes(['verify' => true, 'register' => false]);

// webpage that will give the user the link to reset his password
Route::get('password/reset/link/{token}', function($token){
    return view('auth.passwords.phonelink', compact('token'));
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('file/upload', 'FileController@upload')->name('file.upload');
    Route::resource('orders', 'OrderController')->except(['edit', 'store', 'create']);

    Route::get('users/change_password/{user}', 'UserController@changePasswordForm')->name('users.show_password_form');
    Route::put('users/change_password/{user}', 'UserController@changePassword')->name('users.change_password');
});

Route::group(['middleware' => ['auth', 'verified', 'role:super-admin']], function(){
    
    // Route::resources([
    //     'roles' => 'RoleController', 
    //     'permissions' => 'PermissionController'
    //     ]);

    Route::get('payouts/restaurants', 'PayoutController@indexRestaurants')->name('restaurants.payouts_index');
    Route::get('payouts/shippers', 'PayoutController@indexShippers')->name('shippers.payouts_index');
    Route::get('payouts/{user}', 'PayoutController@createPayout')->name('payouts.create');
    Route::post('payouts/{user}', 'PayoutController@storePayout')->name('payouts.store');
        
    Route::resource('users', 'UserController');
    Route::post('users/block', 'UserController@block')->name('users.block');

    Route::resource('shippers', 'ShipperController')->only(['index', 'show']);
    
    Route::resource('cuisines', 'CuisineController');

    Route::get('settings/general', 'SettingController@editGeneralSetting')->name('settings.general');
    Route::put('update/env/settings', 'SettingController@updateGeneralSetting');

    Route::get('settings/site', 'SettingController@editSiteSetting')->name('settings.site');
    Route::put('update/site/settings', 'SettingController@updateSiteSetting');

    Route::get('edit/privacy', 'SettingController@editPrivacy')->name('settings.edit_privacy');
    Route::put('store/privacy', 'SettingController@storePrivacy')->name('settings.store_privacy');

    Route::get('edit/terms', 'SettingController@editTerms')->name('settings.edit_terms');
    Route::put('store/terms', 'SettingController@storeTerms')->name('settings.store_terms');

    Route::resource('notations', 'NotationController');
    Route::post('toggle/notation/published', 'NotationController@togglePublished')->name('notations.published');

    Route::resource('invoices', 'InvoiceController')->only('update');

    Route::get('restaurants', 'RestaurantController@index')->name('restaurants.index');

    Route::post('toggle/restaurants/activation', 'RestaurantController@toggleActivation')->name('restaurants.activation');
    Route::get('restaurants/{restaurant}/items', 'RestaurantController@showItems')->name('restaurants.items_index');

    Route::resource('payment_methods', 'PaymentMethodController')->only('index');
    Route::post('toggle/payment_methods/activation', 'PaymentMethodController@toggleActivation')->name('payment_methods.activation');

});

Route::group(['middleware' => ['auth', 'verified', 'role:shop-admin']], function(){
    Route::resource('menus', 'MenuController')->except('create');
    Route::get('menus/create/{restaurant_id}', 'MenuController@create')->name('menus.create');
    Route::resource('categories', 'CategoryController')->except('create');
    Route::get('categories/create/{restaurant_id}', 'CategoryController@create')->name('categories.create');
    Route::get('/contact', 'ContactController@create')->name('contact');
    Route::post('/contact', 'ContactController@store')->name('contact.store');
});

Route::group(['middleware' => ['auth', 'verified', 'role:super-admin|shop-admin']], function(){
        
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('documentation', function(){
        return view('documentation');
    })->name('documentation');

    Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);
    
    Route::resource('customers', 'CustomerController')->only('index');
    Route::get('customers/{user}/orders', 'CustomerController@show')->name('customers.orders');

    Route::resource('orders', 'OrderController')->only('put');
    Route::get('orders/export/{order}','OrderController@export_pdf')->name('orders.pdf');

    Route::resource('items', 'ItemController')->except('create');
    Route::get('items/create/{restaurant_id}', 'ItemController@create')->name('items.create');

    Route::resource('supplements', 'SupplementController')->except('create');
    Route::get('supplements/create/{restaurant_id}', 'SupplementController@create')->name('supplements.create');

    Route::resource('restaurants', 'RestaurantController')->except('index');

    Route::put('restaurants/administrator/{restaurant}', 'RestaurantController@defineAdministrator')->name('restaurants.administrator');
    Route::put('restaurants/setting/{restaurant}', 'RestaurantController@setting')->name('restaurants.setting');

    Route::resource('shippings', 'ShippingController')->except(['edit', 'create', 'store']);

    Route::resource('promocodes', 'PromocodeController');
    Route::post('clear/promocodes', 'PromocodeController@clearRedundant')->name('clear.redundant');

    Route::resource('invoices', 'InvoiceController')->only(['index', 'show']);
    Route::get('invoices/export/{id}','InvoiceController@export_pdf')->name('invoices.pdf');

    Route::resource('payments', 'PaymentController');
    Route::get('search/shippers', 'UserController@searchShippers')->name('search.shippers');

    Route::post('order/position', 'ShippingController@getOrderPosition')->name('order.position');

    Route::post('toggle/shops/availability', 'RestaurantController@toggleShopAvailability')->name('shop.availability');

    Route::post('toggle/items/availability', 'ItemController@toggleAvailability')->name('items.availability');
    Route::post('toggle/supplements/availability', 'SupplementController@toggleAvailability')->name('supplements.availability');

    Route::get('payouts/user/{user}', 'PayoutController@show')->name('payouts.show');
    Route::get('payouts/export/{transaction}','PayoutController@export_pdf')->name('payouts.pdf');
});