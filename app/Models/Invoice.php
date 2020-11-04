<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Carbon\Carbon;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'order_id', 'payment_method', 'number', 'total', 'issue_date', 'due_date'];

    public $timestamps = false;
    
    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    /**
     * Accesseurs du titre
     * 
     * @param String $value
     */
    public function getNumberAttribute($value){
        return '#'.$value;
    }

    /**
     * Mutateur de la date d'echeance
     * issue_date + 3h
     * 
     * @param Datatime $date
     */
    public function setDueDateAttribute($date){
        if(empty($date)){
			$this->attributes['due_date'] = Carbon::now()->addHours(3)->toDateTimeString();
		}
    }

    public function getStatusHtmlAttribute(){
        if($this->status == 'paid'){
            return '<span class="label label-success">'.__($this->status).'</span>';
        }elseif($this->status == 'unpaid'){
            return '<span class="label label-danger">'.__($this->status).'</span>';
        }else{
            return '<span class="label label-primary">'.__($this->status).'</span>';
        }
    }
}
