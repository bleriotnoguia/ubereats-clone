<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;
use App;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function privacy(){
        $privacy = Setting::where('key', 'privacy_policy')->first();
        return view('privacy', compact('privacy'));
    }

    public function terms(){
        $terms = Setting::where('key', 'terms_of_use')->first();
        return view('terms', compact('terms'));
    }

    public function lang($locale){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
