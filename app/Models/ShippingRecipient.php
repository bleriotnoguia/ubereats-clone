<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRecipient extends Model
{
    protected $fillable = ['name', 'email', 'phone_number'];

    protected $table = 'shippings_recipients';

    public $timestamps = false;

    public function shipping(){
        return $this->belongTo(Shipping::class);
    }
}
