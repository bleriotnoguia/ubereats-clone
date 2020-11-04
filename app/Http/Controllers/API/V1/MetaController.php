<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Meta;
use Auth;

class MetaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metas = Meta::where('user_id', Auth::user()->id)->get();
        return $this->sendResponse($metas->toArray(), 'Metas retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::user()->id]);
        $input = $request->all();
        $meta = Meta::where('user_id', $input['user_id'])->where('key', $input['key'])->where('value', $input['value'])->first();
        if($meta){
            return $this->sendResponse($meta->toArray(), 'This meta has already been created.');
        }else{
            $meta = Meta::create($input);
        }
        return $this->sendResponse($meta->toArray(), 'Meta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param mixed  $key
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $meta = Meta::where('key', $key)->where('user_id', Auth::user()->id)->first();
        return $this->sendResponse($meta->toArray(), 'Meta retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $key
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        $meta = Meta::where('key', $key)->where('user_id', Auth::user()->id)->first();
        $meta->value = $request->input('value');
        $meta->save();
        return $this->sendResponse($meta->toArray(), 'Meta updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $key
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        $meta = Meta::where('key', $key)->where('user_id', Auth::user()->id)->first();
        $meta->delete();
        return response()->json(['success' => true, 'message' => 'Meta deleted successfully.']);
    }
}
