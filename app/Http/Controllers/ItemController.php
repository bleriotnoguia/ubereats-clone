<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Contracts\ItemRepositoryInterface;

class ItemController extends Controller
{
    private $item;
    /**
     * ItemController constructor
     * 
     * @param ItemRepositoryInterface $item
     */
    public function __construct(ItemRepositoryInterface $item){
        $this->item = $item;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->item->all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $restaurant_id
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        $item = new Item();
        $restaurant_selected = Restaurant::findOrFail($restaurant_id);
            if(Gate::allows('create-items', $restaurant_selected)){
            return view('items.create', compact('item', 'restaurant_selected'));
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
        if(Gate::allows('create-items', $restaurant)){
            
            $item = $this->item->create($request->all());

            foreach ($request->input('document', []) as $file) {
                $item->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }

            Session::flash('success', 'L\'article à bien été ajouté');
            if(Auth::user()->isSuperAdmin()){
                return redirect(route('restaurants.items_index', $restaurant));
            }else{
                return $this->index();
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item  $item)
    {
        // we used modal instead of another page
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item  $item)
    {
        if(Auth::user()->can('update', $item)){
            $restaurant_selected = $item->restaurant;
            return view('items.edit', compact('item', 'restaurant_selected'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequest $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item  $item)
    {
        if(Auth::user()->can('update', $item)){
            if(!isset($request['is_available'])){
                $request->request->add(['is_available' => 'off']);
            }
            if(!$request->input('supplements')){
                $item->supplements()->detach();
            }
            if(!$request->input('obligatory_categories')){
                $item->obligatorySupplementCategory()->detach();
            }
            $this->item->update($request->all(), $item->id);
            if (count($item->getMedia('image')) > 0) {
                foreach ($item->getMedia('image') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $item->getMedia('image')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $item->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
                }
            }

            Session::flash('success', 'L\'article à bien été modifié !');
            return redirect(route('items.edit', $item));
        }
        return back();
    }

    /**
     * Toggle Availability of item
     * 
     */
    public function toggleAvailability(Request $request){
        $item = Item::findOrFail($request->item_id);
        if(Auth::user()->can('update', $item)){
            $item->is_available = $request['is_available'];
            $item->save();
            return response()->json(
                [
                    'success' => true,
                    'message'=> 'La disponibilité de votre article a été mis à jour !', 
                    'data' => $item
                ], 200);
        }
        return response()->json(
                [
                    'success' => false, 
                    'message' => 'Echec de mise à jour. \n Vous n\'avez pas les droits pour effectuer cette action.'
                ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if(Auth::user()->can('delete', $item)){
            $item->delete();
            Session::flash('success', 'L\'article à bien été supprimé !');
        }
        return back();
    }
}
