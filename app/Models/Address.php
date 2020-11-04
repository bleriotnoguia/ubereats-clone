<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'addressable_type', 'addressable_id', 'gmap_address', 'description'
    ];

    protected $casts = [
        'gmap_address' => 'array'
    ];

    public function addressable(){
        return $this->morphTo();
    }

}
