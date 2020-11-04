<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;
use Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $months = Auth::user()->wallet
                        ->transactions()
                        ->whereYear('created_at', date('Y'))
                        ->where('type', 'deposit')
                        ->pluck('created_at')
                        ->map(function ($date, $key) {
                            return $date->month;
                        })->unique()
                        ->toArray();
        asort($months);
        $earnings = []; 
        foreach ($months as $key => $value) {
            $monthNumber = date("F", mktime(0, 0, 0, $value, 1));
            $earnings[$monthNumber] = Auth::user()->wallet
                                            ->transactions()
                                            ->whereMonth('created_at', $value)
                                            ->where('type', 'deposit')
                                            ->get()
                                            ->pluck('amount')
                                            ->sum();
        }

        if(Auth::user()->isSuperAdmin()){
            $users = User::latest()->get();
            $orders = Order::latest()->get();
            $items = Item::latest()->get();
            $shippers = User::shipper()->get();
            return view('dashboard', compact('users', 'items', 'orders', 'shippers', 'earnings'));
        }else{
            $shippers = User::shipper()->get();
            if(Auth::user()->restaurant){
                $customers = Order::where('restaurant_id', Auth::user()->restaurant->id)->with('user')
                            ->get()
                            ->pluck('user')
                            ->unique()
                            ->values();
            }else{
                $customers = collect([]);
            }
            return view('dashboard', compact('customers', 'shippers', 'earnings'));
        }
    }
}
