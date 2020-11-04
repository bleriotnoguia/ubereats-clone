<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Session;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('restaurant_id', Auth::user()->restaurant->id)->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        $category = new Category();
        $restaurant_selected = Restaurant::findOrFail($restaurant_id);
        if(Gate::allows('create-categories', $restaurant_selected)){
            return view('categories.create', compact('category', 'restaurant_selected'));
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
        if(Gate::allows('create-categories', $restaurant)){
            $restaurant->categories()->create([
                'name' => $request->name,
                'type' => $request->type
            ]);
            Session::flash('success', 'La categorie à bien été ajouté');
            return $this->index();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(Auth::user()->can('update', $category)){
            $category->name = $request->input('name');
            $category->type = $request->input('type');
            $category->save();
            Session::flash('success', 'La categorie à bien été modifié');
            return redirect(route('categories.edit', $category));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', 'La categorie à bien été supprimé');
        return back();
    }
}
