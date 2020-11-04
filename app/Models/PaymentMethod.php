<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    // protected $fillable = ['name', 'code', 'active', 'description'];

    protected $fillable = ['active'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * @return string
     */
    public function isActive()
    {
        return $this->active ? __('Yes') : __('No');
    }

    public function setActiveAttribute($value){
        if($value == 'on'){
            $this->attributes['active'] = true;
        }else{
            $this->attributes['active'] = false;
        }
    }

    public function scopeActivated($query){
        $query->where('active', 1);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
