<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Session;
use Auth;

class SupplementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplements = Supplement::with(['category', 'media'])
                        ->where('restaurant_id', Auth::user()->restaurant->id)
                        ->latest()
                        ->get();
        return view('supplements.index', compact('supplements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        $supplement = new Supplement();
        $restaurant_selected = Restaurant::findOrFail($restaurant_id);
        if(Gate::allows('create-supplements', $restaurant_selected)){
            return view('supplements.create', compact('supplement', 'restaurant_selected'));
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
        if(Gate::allows('create-supplements', $restaurant)){
            $supplement = Supplement::create($request->all());
            foreach ($request->input('document', []) as $file) {
                $supplement->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
            Session::flash('success', 'Le supplement à bien été ajouté');
            return redirect(route('supplements.edit', $supplement));
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function show(Supplement $supplement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplement $supplement)
    {
        if(Auth::user()->can('update', $supplement)){
            return view('supplements.edit', compact('supplement'));
        }
        return back();
    }

    /**
     * Toggle Availability of supplement
     * 
     */
    public function toggleAvailability(Request $request){
        $supplement = Supplement::findOrFail($request->supplement_id);
        if(Auth::user()->can('update', $supplement)){
            $supplement->is_available = $request['is_available'];
            $supplement->save();
            return response()->json(
                [
                    'success' => true,
                    'message'=> 'La disponibilité de votre article a été mis à jour !', 
                    'data' => $supplement
                ], 200);
        }
        return response()->json(
                [
                    'success' => false, 
                    'message' => 'Echec de mise à jour. \n Vous n\'avez pas les droits pour effectuer cette action.'
                ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplement $supplement)
    {
        if(Auth::user()->can('update', $supplement)){
            $supplement->update($request->all());
            if (count($supplement->getMedia('image')) > 0) {
                foreach ($supplement->getMedia('image') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $supplement->getMedia('image')->pluck('file_name')->toArray();
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $supplement->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
                }
            }
            Session::flash('success', 'Le supplement à bien été modifié !');
            return redirect(route('supplements.edit', $supplement));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplement $supplement)
    {
        if(Auth::user()->can('delete', $supplement)){
            $supplement->delete();
            Session::flash('success', 'Le supplément à bien été supprimé !');
        }
        return back();
    }
}
