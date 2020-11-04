<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
use Session;
use Auth;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isSuperAdmin()){
            if($request->restaurant_id == null){
                $invoices = Invoice::with(['order', 'order.user', 'order.restaurant'])->orderBy('issue_date', 'desc')->get();
            }else{
                $orders = Order::with('invoice')->where('restaurant_id', $request->restaurant_id)->get();
                $invoices = $orders->pluck('invoice');
            }
        }else{
            $invoices = Invoice::with(['order', 'order.user', 'order.restaurant'])->whereIn('order_id', Auth::user()->restaurant->orders->pluck('id')->toArray())->orderBy('issue_date', 'desc')->get();
        }
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->status = $request->input("status");
        $invoice->save();
        $invoice->payment()->update([
            'status' => 'deposit',
            'amount_paid' => $invoice->total
            ]);
        Session::flash('success', 'Invoice status succefully updated !');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // if(Auth::user()->isSuperAdmin()){
        //     $invoice->delete();
        //     Session::flash('success', 'La facture à bien été supprimé !');
        // }
        return back();
    }

    /**
     * Convert a specified invoice to pdf.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf($id)
    {
      // Fetch all invoices from database
      $invoice = Invoice::with(['payment', 'order', 'order.restaurant'])->findOrFail($id);
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.invoice', compact('invoice'));
      $pdf->setPaper('a4', 'landscape');
      // If you want to store the generated pdf to the server then you can use the store function
      // $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function
      return $pdf->stream('invoice-'.$invoice->number.'.pdf');
    //   return $pdf->download('invoice.pdf');
    }
}
