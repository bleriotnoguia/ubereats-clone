<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];

    // public $timestamps = false;

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
