<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Notation;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Criteria;
use Validator;
use Auth;

class NotationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notations = Notation::Published()->with('criteria')
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return $this->sendResponse($notations->toArray(), 'Notations successfully retrieved !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'model_name' => 'required|string',
            'model_id' => 'required|integer',
            'star' => 'required|integer|min:0|max:5',
            'criteria' => 'array',
            'criteria.*' => 'integer',
            'like' => 'required|boolean',
            'comment' => 'string'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $notation = new Notation();
        if($input['model_name'] == 'order'){
            $notation->notable_type = Order::class;
            $model = Order::find($input['model_id']);
            if($model->status != 'shipped'){
                return $this->sendError('The order must be shipped before receiving a rating');
            }
        }elseif($input['model_name'] == 'shipping'){
            $notation->notable_type = Shipping::class;
            $model = Shipping::find($input['model_id']);
            if($model->status != 'done'){
                return $this->sendError('The shipping must be done before receiving a rating');
            }
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
        if($model->notation()->where('notable_type', get_class($model))->first()){
            return $this->sendError($input['model_name'].' with id = '.$input['model_id'].' already have a notation !');
        }
        if(!$owner_condition){
            return $this->sendError('You are not corcerned by the '.$input['model_name'].' with id = '.$input['model_id'].' !');
        }
        $notation->user_id = Auth::user()->id;
        $notation->star = $input['star'];
        $notation->like = $input['like'];
        $notation->is_published = 1;
        if(isset($input['comment']) && $input['comment']){
            $notation->comment = $input['comment'];
        }
        $notation->save();
        if(isset($input['criteria']) && $input['criteria']){
            $notation->criteria()->sync($input['criteria']);
        }
        return $this->sendResponse($notation->toArray(), 'Notation successfully saved !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notation = Notation::Published()->with('criteria')->find($id);
        if(!$notation){
            return response()->json(['success'=> false, 'message' => 'Notation with id = '.$id.' not found !']);
        }
        return $this->sendResponse($notation->toArray(), 'Notation retrieved successfully !');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function criteria($type)
    {
        $criteria = Criteria::where('type', $type)->get();
        return $this->sendResponse($criteria->toArray(), 'Criteria retrieved successfully !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notation = Notation::find($id);
        if(!$notation){
            return $this->sendError('Notation with id = '.$id.' not found !');
        }
        if(Auth::user()->can('update', $notation)){
            $input = $request->all();
            $validator = Validator::make($input, [
                'id' => 'required|integer',
                'star' => 'required|integer|min:0|max:5',
                'like' => 'required',
                'criteria' => 'array',
                'criteria.*' => 'integer',
                'like' => 'required|boolean',
                'comment' => 'string'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation error'. $validator->errors());
            }
            $notation->update($input);
            return $this->sendResponse($notation->toArray(), 'Notation successfully updated');
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notation = Notation::find($id);
        if(Auth::user()->can('delete', $notation)){
            $notation->delete();
            return response()->json(['success' => true, 'message' => 'Notation deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }
}
