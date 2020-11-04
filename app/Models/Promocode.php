<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// use Gabievi\Promocodes\Models\Promocode;

class Promocode extends \Gabievi\Promocodes\Models\Promocode
{
    protected $appends = ['state'];

    public function getDataAttribute($value){
        return json_decode($value);
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function getStateAttribute(){
        // On verifie si le code coupon est exppiré ou si le nombre limite d'utilisateur est atteint
        if(Carbon::parse($this->expires_at)->isPast() || ($this->data->coupon_type == 'some_user' && $this->quantity <= $this->users->count())){
            return "<span class='label label-danger'>".__('end')."</span>";
        }elseif(isset( $this->data->start_at) && !Carbon::createFromFormat('d/m/Y', $this->data->start_at)->isPast())
            return "<span class='label label-primary'>".__('planned')."</span>";
        else{
            return "<span class='label label-success'>".__('active')."</span>";
        }
    }

}
