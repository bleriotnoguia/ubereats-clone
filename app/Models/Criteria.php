<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';

    protected $fillable = ['name', 'type'];
    
    public $timestamps = false;

    /**
     * Accesseurs du nom du critère qui effectue la traduction avant le retour de la valeur
     * 
     * @param String $value
     */
    public function getNameAttribute($value){
        return __($value);
    }

    public function notations(){
        return $this->belongsToMany(Notation::class, 'notations_has_criteria', 'criteria_id', 'notation_id');
    }
}
