<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use App\Notifications\UbereatsPayout;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Restaurant;
use App\Models\User;
use Auth;
use PDF;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRestaurants()
    {
        $restaurants = Restaurant::all();
        return view('payouts.restaurants.index', compact('restaurants'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShippers()
    {
        $shippers = User::shipper()->get();
        return view('payouts.shippers.index', compact('shippers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPayout(Request $request, User $user)
    {
        return view('payouts.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePayout(Request $request, User $user)
    {
        if($user->canWithdraw($request->amount) && $request->amount > 0){
            $user->withdraw($request->amount, 'withdraw', ['note' => $request->note]);
            if($user->hasrole('shipper')){
                $user->notify(new UbereatsPayout($request->amount));
            }else if($user->isShopAdmin()){
                $user->notify(new UbereatsPayout($request->amount));
            }
            Session::flash('success', 'Transaction successfully completed');
        }else{
            Session::flash('danger', 'Transaction canceled. Pay less than or equal to the amount in the wallet');
        }
        if($user->hasrole('shipper')){
            $this->indexShippers();
        }else if($user->isShopAdmin()){
            $this->indexRestaurants();
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Gate::allows('show-payout-transactions', $user)){
            if(!$user->isSuperAdmin()){
                if($user->isShipper()){
                    $builder = $user->shippings();
                }else if($user->isShopAdmin()){
                    $builder = $user->restaurant->orders();
                }
                $amount_lost['month'] = $builder->whereMonth('created_at', date('m'))
                                            ->where('status', 'canceled')
                                            ->get()
                                            ->pluck('total')
                                            ->sum();
            }
        
            $amount_won['month'] = $user->wallet
                                            ->transactions()
                                            ->whereMonth('created_at', date('m'))
                                            ->get()
                                            ->pluck('amount')
                                            ->sum();
        
            $amount_won['year'] = $user->wallet
                                        ->transactions()
                                        ->whereYear('created_at', date('Y'))
                                        ->get()
                                        ->pluck('amount')
                                        ->sum();

            $months = $user->wallet
                            ->transactions()
                            ->whereYear('created_at', date('Y'))
                            ->where('type', 'deposit')
                            ->pluck('created_at')
                            ->map(function ($date, $key) {
                                        return $date->month;
                                    })->unique()->toArray();
            asort($months);
            $earnings = [];
            foreach ($months as $key => $value) {
                $earnings[date("F", mktime(0, 0, 0, $value, 1))] = $user->wallet
                    ->transactions()
                    ->whereMonth('created_at', $value)
                    ->where('type', 'deposit')
                    ->get()
                    ->pluck('amount')
                    ->sum();
            }
            
            if($user->hasrole('shipper')){
                return view('payouts.shippers.show', compact('user', 'amount_won', 'amount_lost', 'earnings'));
            }elseif($user->isShopAdmin()){
                return view('payouts.restaurants.show', compact('user', 'amount_won', 'amount_lost', 'earnings'));
            }elseif($user->isSuperAdmin()){
                return view('payouts.show', compact('user', 'amount_won', 'earnings'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function edit(Payout $payout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payout $payout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payout $payout)
    {
        //
    }

    /**
     * Convert a specified transaction to pdf.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function export_pdf(Transaction $transaction)
    {
      $data = ['transaction' => $transaction];
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.transaction', $data);
      // If you want to store the generated pdf to the server then you can use the store function
      // $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function
      return $pdf->download($transaction->hash.'.pdf');
    }
}
