<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Item;
use Validator;

class ItemController extends BaseController
{
    /**
     * Display a listing of the ressource.
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(){
        $items = Item::paginate(10);
        return $this->sendResponse($items->toArray(), 'Items retrieved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $item = Item::with(['cuisine', 'restaurant', 'category'])->findOrFail($id);
        return $this->sendResponse($item->toArray(), 'Item retrieved successfully');
    }

    public function showItemsByRestaurant($id){
        $items = Item::with('restaurant')->where('restaurant_id', $id)->paginate(10);
        return $this->sendResponse($items->toArray(), 'Specific restaurant items recovered successfully');
    }

    public function showItemsByCategory(Request $request, $id){
        if($request->restaurant_id){
            $items = Item::where([
                    ['restaurant_id', $request->restaurant_id],
                    ['category_id', $id]
                ])->get();
        }else{
            $items = Item::where('category_id', $id)->paginate(10);
        }
        return $this->sendResponse($items->toArray(), 'Specific category items recovered successfully');
    }

    public function showItemsByMenu(Request $request, $id){
        if($request->restaurant_id){
            $items = Item::where([
                    ['restaurant_id', $request->restaurant_id],
                    ['menu_id', $id]
                ])->get();
        }else{
            $items = Item::where('menu_id', $id)->paginate(10);
        }
        return $this->sendResponse($items->toArray(), 'Specific menu items recovered successfully');
    }

    public function showItemsByCuisine($id){
        $items = Item::where('cuisine_id', $id)->paginate(10);
        return $this->sendResponse($items->toArray(), 'Specific cuisine items recovered successfully');
    }

    /**
     * Return items sorted by retaurants and cuisines
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showItems(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'restaurants' => 'array',
            'cuisines' => 'array',
            'restaurants.*' => 'integer',
            'cuisines.*' => 'integer',
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validator error', $validator->errors());
        }

        if(empty($input['restaurants']) && empty($input['cuisines'])){
            $items = collect([]);
        }else{
            if(!empty($input['restaurants'])){
                $builder = Item::whereIn('restaurant_id', $input['restaurants']);
            }
            if(!empty($input['cuisines'])){
                if(empty($input['restaurants'])){
                    $builder = Item::whereIn('cuisine_id', $input['cuisines']);
                }else{
                    $builder = $builder->whereIn('cuisine_id', $input['cuisines']);
                }
            }
            $items = $builder->paginate(10);
        }
        return $this->sendResponse($items->toArray(), 'Items sorted by restaurants & cuisines recovered successfully');
    }
}
