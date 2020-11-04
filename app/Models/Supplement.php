<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Storage;

class Supplement extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'id', 'name', 'price', 'description', 'restaurant_id', 'category_id', 'is_available'
    ];

    protected $appends = ['profile_img', 'media_links'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_available' => 'boolean'
    ];
    
    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function setIsAvailableAttribute($value){
        if($value == 'on'){
            $this->attributes['is_available'] = true;
        }else{
            $this->attributes['is_available'] = false;
        }
    }

    // the method used to get the profile of item
    public function getProfileImgAttribute(){
        if($this->media_links){
            $link = $this->media_links[0];
        }else {
            $link = Storage::url('items/default.png');
        }
        return $link;
    }
    public function getMediaLinksAttribute(){
        $mediaLinks = [];
        foreach ($this->getMedia('image') as $key => $media) {
            $urlParts = explode('public', $media->getPath());
            $filePath = "storage" . $urlParts[sizeof($urlParts) - 1];
            array_push($mediaLinks, $filePath);    
        }
        return $mediaLinks;
    }
    public function getCreatedAtAttribute($value){
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y à H:i');
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y à H:i');
    }

    public function orderLines(){
        return $this->morphMany(OrderLine::class, 'model');
    }
}
