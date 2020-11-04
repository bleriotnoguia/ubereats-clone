<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Restaurant;
use App\Models\Item;
use App\Models\Category;
use Validator;

class RestaurantController extends BaseController
{
    /**
     * Display a listing of the ressource.
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request){
        $shop_data = ['cuisines', 'programmes', 'notations', 'menus', 'categories'];
            if($request->is_merchant){
                $restaurants = Restaurant::Activated()
                                ->where('is_merchant', $request->is_merchant)
                                ->with($shop_data)
                                ->get();
            }else{
                $restaurants = Restaurant::Activated()
                                ->with($shop_data)
                                ->get();
            }
            if($request->postal_code){
                $restaurants = $restaurants->filter(function ($restaurant, $key) use($request){
                    return $restaurant->postal_code == $request->postal_code;
                });
            }
        return $this->sendResponse($restaurants->toArray(), 'Restaurants retrieved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $restaurant = Restaurant::with(['cuisines', 'programmes', 'notations', 'menus', 'categories'])->findOrFail($id);
        $restaurant->cuisines->toArray();
        return $this->sendResponse($restaurant->toArray(), 'Restaurant retrieved successfully');
    }

    public function showRestaurantsByCuisine($id){
        $restaurants = Restaurant::Activated()->with(['cuisines', 'programmes', 'notations', 'menus', 'categories'])->paginate(10);
        $restaurants = $restaurants->filter(function($shop) use($id){
            return in_array($id, $shop->cuisines->pluck('id')->toArray());
        });
        return $this->sendResponse($restaurants->toArray(), 'Specific cuisine restaurants recovered successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showRestaurantsByDistance(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_longitude' => 'required',
            'user_latitude' => 'required'
        ]); 
        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors());
        }
        if(isset($request->is_merchant)){
            $restaurants = Restaurant::Activated()->with(['cuisines', 'programmes', 'notations', 'menus', 'categories'])->where('is_merchant', $request->is_merchant)->get();
        }else{
            $restaurants = Restaurant::Activated()->with(['cuisines', 'programmes', 'notations', 'menus', 'categories'])->get();
        }
        $shop_located_at = env('SHOP_LOCATED_AT');
        $restaurants = $restaurants->filter(function($shop) use($input, $shop_located_at){
            // On ne retourne pas les restaurants n'ayant pas d'address
            if(!$shop->address){
                return;
            }
            // distance method is a helper stored in app\Helpers
            $located_at = round(distance($input['user_latitude'], $input['user_longitude'], $shop->latitude, $shop->longitude), 3);
            $shop->located_at = $located_at;
            return $located_at <= $shop_located_at;
        });
        return $this->sendResponse($restaurants->values()->toArray(), 'Liste des restaurants se trouvant a une distance inférieur ou égale à '.$shop_located_at. ' km');
    }

    /**
     * Get list of menus of a specific restaurant
     * 
     * @param App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function getMenus(Restaurant $restaurant){
        $menus = $restaurant->menus;
        return $this->sendResponse($menus, 'All menus retrieved successfully.');
    }

    /**
     * Get list of menus of a specific restaurant
     * 
     * @param App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function getCategories(Restaurant $restaurant){
        $categories = $restaurant->categories;
        return $this->sendResponse($categories, 'All categories retrieved successfully.');
    }

}
