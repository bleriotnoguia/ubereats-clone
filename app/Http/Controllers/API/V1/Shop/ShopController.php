<?php

namespace App\Http\Controllers\API\V1\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Auth;

class ShopController extends BaseController
{
    /**
     * Toggle the availability of the shop
     * 
     */
    public function toggleShopAvailability(Request $request){
        $restaurant = Auth::user()->restaurant;
        $validator = Validator::make($request->all(), [
            'is_open' => 'in:on,off,1,0'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator error', $validator->errors());
        }
        $programme = $restaurant->programmes()->where('day_id', date('N'))->first();
        if(!$programme){
            return response()->json(
                [
                    'success' => false, 
                    'message' => 'La journée d\'aujourd\'hui n\'ai pas renseigné dans votre programme ! Mettez à jour vos horaires d\'ouverture '
                ], 500);
        }
        $is_between_open_time = strtotime($programme->open_time) <= strtotime(date('H:i:s')) && strtotime(date('H:i:s')) < strtotime($programme->close_time);
        if(!$is_between_open_time){
            return response()->json(
                [
                    'success' => false, 
                    'message' => 'Vous ne pouvez pas ouvrir votre boutique dans votre intervale de fermeture ! Mettez plutôt à jour vos horaires d\'ouverture '
                ], 500);
        }
        $restaurant->is_open = $request['is_open'];
        $restaurant->save();
        return response()->json(
            [
                'success' => true,
                'message'=> 'La disponibilité de votre boutique a été mis à jour !', 
                'data' => $restaurant
            ], 200);
    }
}
