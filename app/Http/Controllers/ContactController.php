<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function create(){
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mail::to(env('CONTACT_SUPPORT'))
            ->send(new Contact($request->except('_token')));

        Session::flash('success', 'Votre message a bien été transmis !');
        return view('contact');
    }
}
