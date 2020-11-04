<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ShipperController extends Controller
{
    public function index(){
        $shippers = User::shipper()->get();
        return view('shippers.index', compact('shippers'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        if(Auth::user()->can('create', $user)){
            return view('users.create', compact('user'));
        }
       return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $shipper
     * @return \Illuminate\Http\Response
     */
    public function show(User $shipper){
        return view('shippers.show', compact('shipper'));
    }
}
