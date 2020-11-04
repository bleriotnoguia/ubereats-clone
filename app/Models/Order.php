<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['number', 'user_id', 'restaurant_id', 'comment', 'status', 'ready_at', 'delay_added', 'coupon_data'];
    
    protected $appends = ['total', 'total_to_pay', 'reduction'];

    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $hidden = ['user_id'];

    protected $casts = [
        'coupon_data' => 'array'
    ];

    public function orderLines(){
        return $this->hasMany(OrderLine::class);
    }

    public function orderStatusHistory(){
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function getTotalAttribute(){
        if($this->orderLines){
            return $this->orderLines->sum('subtotal');
        }
        return null;
    }

    public function getTotalToPayAttribute(){
        if($this->coupon_data['code']){
            if($this->coupon_data['discount_type'] == 'percent'){
                $total_to_pay = $this->total - $this->total*$this->coupon_data['discount_percent']/100;
            }elseif($this->coupon_data['discount_type'] == 'amount'){
                $total_to_pay = $this->total - $this->coupon_data['discount_amount'];
            }
        }else{
            $total_to_pay = $this->total;
        }
        if(isset($this->shipping->fee)){
            $total_to_pay = $total_to_pay + $this->shipping->fee;
        }
        return $total_to_pay;
    }

    public function getReductionAttribute(){
        if($this->coupon_data['code']){
            if($this->coupon_data['discount_type'] == 'percent'){
                $reduction = $this->total*$this->coupon_data['discount_percent']/100;
            }elseif($this->coupon_data['discount_type'] == 'amount'){
                $reduction = $this->coupon_data['discount_amount'];
            }
        }else{
            $reduction = 0;
        }
        return $reduction;
    }

    /**
     * Accesseurs du titre
     * 
     * @param String $value
     */
    public function getNumberAttribute($value){
        return '#'.$value;
    }

    public function getStatusHtmlAttribute(){
        switch($this->status){
            case 'canceled': 
                $type = 'danger';
                break;
            case 'pending':
                $type = 'warning';
                break;
            case 'confirmed':
                $type = 'primary';
                break;
            case 'ready':
                $type = 'info';
                break;
            case 'shipped':
            case 'in_shipment':
                $type = 'success';
                break;
            default:
                $type = 'default';
        }
        return '<span class="label label-'.$type.'">'.__($this->status).'</span>';
    }
    
    public function shipping(){
        return $this->hasOne(Shipping::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function notation(){
        return $this->morphOne(Notation::class, 'notable');
    }

}
