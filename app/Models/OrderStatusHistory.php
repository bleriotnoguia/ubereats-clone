<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $fillable = ['order_id', 'status', 'updated_at'];

    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
