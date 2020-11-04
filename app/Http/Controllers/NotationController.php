<?php

namespace App\Http\Controllers;

use App\Models\Notation;
use App\Models\Criteria;
use App\Models\Shipping;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Session;

class NotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->restaurant_id == null){
            $notations = Notation::with(['user', 'notable'])->latest()->get();
        }else{
            $orders = Order::with('notation')->where('restaurant_id', $request->restaurant_id)->latest()->get();
            $notations1 = $orders->pluck('notation')->filter(function($item, $key){
                return $item != null;
            });
            $shippings = Shipping::with('order', 'notation')->latest()->get();
            $shippings = $shippings->filter(function($item, $key) use($request){
                return $item->order->restaurant_id == $request->restaurant_id;
            });
            $notations2 = $shippings->pluck('notation')->filter(function($item, $key){
                return $item != null;
            });
            $notations = $notations1->merge($notations2);
        }
        return view('notations.index', compact('notations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $notation = new Notation();
        $criteria = Criteria::where('type', $request->type)->get();
        return view('notations.create', compact('notation', 'criteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Comment passer le model_id ??
        $input = $request->all();
        dd($input);
        $this->validate($request, [
            'model_name' => 'required|string',
            'model_id' => 'required|integer',
            'user_id' => 'required|integer',
            'type' => 'required',
            'star' => 'required|integer|min:0|max:5',
            'criteria' => 'array',
            'criteria.*' => 'integer',
            'like' => 'required|boolean',
            'comment' => 'string'
        ]);
        $notation = new Notation();
        if($input['model_name'] == 'order'){
            $notation->notable_type = Order::class;
            $model = Order::find($input['model_id']);
        }elseif($input['model_name'] == 'shipping'){
            $notation->notable_type = Shipping::class;
            $model = Shipping::find($input['model_id']);
        }else{
            return $this->sendError('model field can only take 2 values : order or shipping');
        }
        $notation->notable_id = $input['model_id'];
        if($model){
            if($input['model_name'] == 'order'){
                $owner_condition = $model->user_id == Auth::user()->id;
            }else{
                $owner_condition = $model->order->user_id == Auth::user()->id;
            }
        }else{
            return $this->sendError($input['model_name'].' with id = '.$input['model_id'].' not found !');
        }
        if($model->notation()->where('model_type', get_class($model))->first()){
            return $this->sendError($input['model_name'].' with id = '.$input['model_id'].' already have a notation !');
        }
        if(!$owner_condition){
            return $this->sendError('You are not corcerned by the '.$input['model_name'].' with id = '.$input['model_id'].' !');
        }
        $notation->user_id = Auth::user()->id;
        $notation->star = $input['star'];
        $notation->like = $input['like'];
        if(isset($input['comment']) && $input['comment']){
            $notation->comment = $input['comment'];
        }
        $notation->save();
        if(isset($input['criteria']) && $input['criteria']){
            $notation->criteria()->sync($input['criteria']);
        }
        Session::flash('success', 'La notation à bien été ajouté');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notation  $notation
     * @return \Illuminate\Http\Response
     */
    public function show(Notation $notation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notation  $notation
     * @return \Illuminate\Http\Response
     */
    public function edit(Notation $notation)
    {
        $type = strtolower(class_basename(get_class($notation->notable)));
        $criteria = Criteria::where('type', $type)->get();
        return view('notations.edit', compact('notation', 'criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notation  $notation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notation $notation)
    {
        if(Auth::user()->can('update', $notation)){
            $input = $request->all();
            $this->validate($request, [
                'star' => 'required|integer|min:0|max:5',
                'like' => 'required',
                'criteria' => 'array',
                'criteria.*' => 'integer',
                'like' => 'required|boolean',
                'comment' => 'string'
            ]);
            $notation->update($input);
            Session::flash('success', 'La notation à bien été modifié');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notation  $notation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notation $notation)
    {
        $notation->delete();
        Session::flash('success', 'La notation à bien été supprimé !');
        return back();
    }

    public function togglePublished(Request $request){
        $notation = Notation::findOrFail($request->notation_id);
        if(Auth::user()->can('update', $notation)){
            $notation->is_published = $request['is_published'];
            $notation->save();
            return response()->json(
                [
                    'success' => true,
                    'message'=> 'Mise à jour réussie !', 
                    'data' => $notation
                ], 200);
        }
        return response()->json(
                [
                    'success' => false, 
                    'message' => 'Echec de mise à jour !'
                ], 404);
    }
}
