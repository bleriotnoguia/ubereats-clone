<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'type'];

    // public $timestamps = false;

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Accesseurs du nom de la categorie qui effectue la traduction avant le retour de la valeur
     * 
     * @param String $value
     */
    public function getNameAttribute($value){
        return ucfirst(__($value));
    }

    public function scopeForSupplements($query){
        $query->where('type', 'supplements');
    }

    public function scopeForItems($query){
        $query->where('type', 'items');
    }
}
