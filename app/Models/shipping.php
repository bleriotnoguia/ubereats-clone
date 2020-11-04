<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FormatDates;
use \Carbon\Carbon;

class Shipping extends Model
{
    use SoftDeletes, FormatDates;

    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['shipped_at', 'planned_at', 'fee', 'number', 'status', 'user_id', 'order_id'];

    protected $appends = ['location', 'country_name', 'city_name'];

    public function getLocationAttribute(){
        if ($this->address && $this->address->gmap_address) {
            return $this->address->gmap_address['formatted_address'];
        }
    }

    public function getCountryNameAttribute(){
        if ($this->address && $this->address->gmap_address) {
            foreach($this->address->gmap_address['address_components'] as $key => $val){
                foreach($val['types'] as $key1 => $val1){
                    if($val1 == 'country'){
                        return $val['long_name'];
                    }
                }
            }
        }
    }

    public function getCityNameAttribute(){
        if ($this->address && $this->address->gmap_address) {
            foreach($this->address->gmap_address['address_components'] as $key => $val){
                foreach($val['types'] as $key1 => $val1){
                    if($val1 == 'locality'){
                        return $val['long_name'];
                    }
                }
            }
        }
    }

    public function getShippedAtAttribute($date){
        if($date){
            return Carbon::parse($date)->format('d.m.Y H:i');
        }
        return null;
    }

    public function setPlannedAtAttribute($date){
        if($date){
            $this->attributes['planned_at'] = Carbon::createFromFormat('d/m/Y H:i:s', $date)->toDateTimeString();
        }else{
            $this->attributes['planned_at'] = null;
        }
    }
    public function getStatusHtmlAttribute(){
        switch($this->status){
            case 'canceled': 
                $type = 'danger';
                break;
            case 'pending':
                $type = 'warning';
                break;
            case 'in_progress':
                $type = 'primary';
                break;
            case 'planned':
                $type = 'info';
                break;
            case 'shipped':
            case 'done':
                $type = 'success';
                break;
            default:
                $type = 'default';
        }
        return '<span class="label label-'.$type.'">'.__($this->status).'</span>';
    }
    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notation(){
        return $this->morphOne(Notation::class, 'notable');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function recipient(){
        return $this->hasOne(ShippingRecipient::class, 'shipping_id');
    }
    
}
