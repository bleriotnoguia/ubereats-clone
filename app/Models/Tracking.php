<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = ['user_id', 'longitude', 'latitude'];

    public $timestamps = false;


    public function user(){
        return $this->belongsTo(User::class);
    }

}
