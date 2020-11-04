<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notation extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id' ,'notable_type', 'notable_id', 'is_published', 'comment', 'star', 'like', 'criteria'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'like' => 'boolean',
        'is_published' => 'boolean'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notable(){
        return $this->morphTo();
    }

    public function getRestaurantAttribute(){
        if(class_basename($this->notable) == 'Order'){
           return $this->notable->restaurant;
        }else if(class_basename($this->notable) == 'Shipping'){
            return $this->notable->order->restaurant;
        }
    }

    public function getTypeAttribute(){
        if(class_basename($this->notable_type) == 'Order'){
            return 'order';
        }elseif(class_basename($this->notable_type) == 'Shipping'){
            return 'shipping';
        }
    }

    public function getOrderAttribute(){
        if($this->type == 'order'){
            return $this->notable;
        }elseif($this->type == 'shipping'){
            return $this->notable->order;
        }
    }

    public function scopePublished($query){
        $query->where('is_published', 1);
    }

    public function setIsPublishedAttribute($value){
        if($value == 'on'){
            $this->attributes['is_published'] = true;
        }else{
            $this->attributes['is_published'] = false;
        }
    }

    public function setCriteriaAttribute($value){
        if($this->id){
            return $this->criteria()->sync($value); 
        }
    }

    public function criteria(){
        return $this->belongsToMany(Criteria::class, 'notations_has_criteria', 'notation_id', 'criteria_id');
    }
}
