<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'payment_id', 'amount_paid', 'meta', 'status', 'invoice_id', 'payment_method_id'];

    protected $casts = [
        'meta' => 'array'
    ];

    protected $appends = ['method'];

    public function getMethodAttribute(){
        return DB::table('payment_methods')->where('id', $this->payment_method_id)->first()->name;
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getStatusHtmlAttribute(){
        if($this->status == 'deposit'){
            return '<span class="label label-success">'.__($this->status).'</span>';
        }elseif($this->status == 'undeposit'){
            return '<span class="label label-danger">'.__($this->status).'</span>';
        }else{
            return '<span class="label label-primary">'.__($this->status).'</span>';
        }
    }
}
