<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\EditRestaurantRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::with(['address'])->latest()->get();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Display a listing of the restaurant's items.
     * 
     */
    public function showItems(Restaurant $restaurant){
        $items = $restaurant->items;
        return view('restaurants.indexitems', compact('items','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = new Restaurant();
        if(Auth::user()->can('create', Restaurant::class)){
            if(Auth::user()->isSuperAdmin()){
                // On recupère la liste des restaurateur n'ayant pas encore de restaurant
            $restaurant_admins = User::shopAdmin()
            ->get()
            ->filter(function ($admin, $key) {
                return !isset($admin->restaurant);
            })
            ->pluck('email', 'id')
            ->toArray();
                return view('restaurants.create', compact(['restaurant', 'restaurant_admins']));
            }
            return view('restaurants.create', compact('restaurant'));
        }
        return redirect(route('dashboard'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRestaurantRequest $request)
    {
        if(Auth::user()->can('create', Restaurant::class)){
            $restaurant = Restaurant::create($request->all());
            foreach ($request->input('document', []) as $file) {
                $restaurant->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
            Session::flash('success', 'La boutique à bien été creé !');
            if(Auth::user()->isSuperAdmin()){
                return redirect(route('restaurants.index'));
            }else{
                return redirect(route('restaurants.show', $restaurant));
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if(Auth::user()->can('view', $restaurant)){
            $restaurant->load('user');
            return view('restaurants.show', compact('restaurant'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if(Auth::user()->cant('update', $restaurant)){
            return back();
        }
        $restaurant = $restaurant;
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest $request
     * @param  \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(EditRestaurantRequest $request, Restaurant $restaurant)
    {
        if(Auth::user()->can('update', $restaurant)){
            if(!request()->get('cuisines')){
                $restaurant->cuisines()->detach();
            }
    
            if (count($restaurant->getMedia('image')) > 0) {
                foreach ($restaurant->getMedia('image') as $media) {
                    if (!in_array($media->file_name, request()->get('document', []))) {
                        $media->delete();
                    }
                }
            }
    
            $media = $restaurant->getMedia('image')->pluck('file_name')->toArray();
    
            foreach (request()->get('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $restaurant->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
                }
            }
            $restaurant->update($request->all());
            if($restaurant->address){
                $restaurant->address()->update([
                    'description' => request()->get('address_description'),
                    'gmap_address' => request()->get('gmap_address')
                ]);
            }else{
                $restaurant->address()->create([
                    'description' => request()->get('address_description'),
                    'gmap_address' => json_decode(request()->get('gmap_address'))
                ]);
            }
            Session::flash('success', 'La boutique à bien été modifié !');
            return back();
        }
        return redirect(route('restaurants.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if(Auth::user()->can('delete', $restaurant)){
            Restaurant::destroy($restaurant->id);
            Session::flash('success', 'La boutique à bien été supprimé !');
        }
        return redirect(route('restaurants.index'));
    }

    /**
     * Toggle Availability of item
     * 
     */
    public function toggleActivation(Request $request){
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        if(Auth::user()->can('update', $restaurant)){
            $restaurant->active = $request['active'];
            $restaurant->save();
            return response()->json(
                [
                    'success' => true,
                    'message'=> 'Mise à jour réussie !', 
                    'data' => $restaurant
                ], 200);
        }
        return response()->json(
                [
                    'success' => false, 
                    'message' => 'Echec de mise à jour. \n Vous n\'avez pas les droits pour effectuer cette action.'
                ], 404);
    }

    /**
     * Toggle the availability of the shop
     * 
     */
    public function toggleShopAvailability(Request $request){
        $restaurant = Auth::user()->restaurant;
        if($request['is_open'] == 'on'){
            $programme = $restaurant->programmes()->where('day_id', date('N'))->first();
            if(!$programme){
                return response()->json(
                    [
                        'success' => false, 
                        'message' => 'La journée d\'aujourd\'hui n\'ai pas renseigné dans votre programme ! Mettez à jour vos horaires d\'ouverture '
                    ], 500);
            }
            // Il est a noter que date() recupère l'heure sur le serveur
            $is_between_open_time = strtotime($programme->open_time) <= strtotime(date('H:i:s')) && strtotime(date('H:i:s')) < strtotime($programme->close_time);
            if(!$is_between_open_time){
                return response()->json(
                    [
                        'success' => false, 
                        'message' => 'Vous ne pouvez pas ouvrir votre boutique dans votre intervale de fermeture ! Mettez plutôt à jour vos horaires d\'ouverture '
                    ], 500);
            }
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
