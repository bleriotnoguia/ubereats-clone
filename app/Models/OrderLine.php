<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    // protected $table = 'order_lines';

    protected $fillable = ['quantity', 'order_id', 'model_id', 'model_type', 'model_price', 'comment'];

    public $timestamps = false;

    protected $appends = ['subtotal'];

    public function order(){
        return $this->belongsTo('Order');
    }

    public function getSubtotalAttribute(){
        if($this->model){
            return $this->quantity * $this->model_price;
        }
        return null;
    }

    public function model(){
        return $this->morphTo()->withTrashed();
    }
}
