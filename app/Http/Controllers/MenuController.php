<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::where('restaurant_id', Auth::user()->restaurant->id)->get();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $restaurant_id
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        $menu = new Menu();
        $restaurant_selected = Restaurant::findOrFail($restaurant_id);
        if(Gate::allows('create-menus', $restaurant_selected)){
            return view('menus.create', compact('menu', 'restaurant_selected'));
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
        if(Gate::allows('create-menus', $restaurant)){
            // dd($request->name);
            $restaurant->menus()->create([
                'name' => $request->name
            ]);
            Session::flash('success', 'La menu à bien été ajouté');
            return $this->index();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        if(Auth::user()->can('update', $menu)){
            $menu->name = $request->input('name');
            $menu->save();
            Session::flash('success', 'Le menu à bien été modifié');
            return redirect(route('menus.edit', $menu));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        Session::flash('success', 'Le menu à bien été supprimé');
        return back();
    }
}
