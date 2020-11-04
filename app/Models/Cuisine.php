<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuisine extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];

    // public $timestamps = false;

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'restaurants_has_cuisines', 'cuisine_id', 'restaurant_id');
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function getNameAttribute($value){
        return ucfirst(__($value));
    }
}
