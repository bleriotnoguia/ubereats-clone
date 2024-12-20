<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onesignal extends Model
{
    protected $fillable = ['user_id', 'player_id'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
