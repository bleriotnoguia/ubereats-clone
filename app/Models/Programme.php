<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = ['day_id', 'open_time', 'close_time', 'restaurant_id']; 

    public $timestamps = false;

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
