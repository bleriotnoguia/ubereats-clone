<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'wallet_transactions';

    protected $fillable = [
        'wallet_id', 'amount', 'hash', 'type', 'accepted', 'meta'
    ];

    protected $casts = [
        'amount' => 'float',
        'meta' => 'array'
    ];
    
    /**
     * Retrieve the wallet from this transaction
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
    /**
     * Retrieve the amount with the positive or negative sign
     */
    public function getAmountWithSignAttribute()
    {
        return in_array($this->type, ['deposit', 'refund'])
            ? '+' . $this->amount
            : '-' . $this->amount;
    }

    public function getInitialAmountAttribute(){
        if($this->wallet->user->hasrole('shipper')){
            if(isset($this->meta['shipping_fee'])){
                return $this->meta['shipping_fee'];
            }
        }elseif($this->wallet->user->hasAnyRole(['shop-admin', 'super-admin'])){
            if(isset($this->meta['order_total'])){
                return $this->meta['order_total'];
            }
        }
        return null;
    }

    public function getUbereatsFeeAttribute(){
        if(isset($this->meta['ubereats_fee'])){
            return $this->meta['ubereats_fee'];
        }
        return null;
    }

    public function getOrderNumberAttribute(){
        if(isset($this->meta['order_number'])){
            return $this->meta['order_number'];
        }
        return null;
    }

    public function getOrderIdAttribute(){
        if(isset($this->meta['order_id'])){
            return $this->meta['order_id'];
        }
        return null;
    }
}
