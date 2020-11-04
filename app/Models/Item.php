<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FormatDates;
use Carbon\Carbon;
use Storage;

class Item extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes, FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'price', 'old_price', 'description', 'is_available', 'restaurant_id', 'menu_id', 'category_id', 'cuisine_id', 'supplements', 'obligatory_categories'
    ];

    protected $hidden = ['media', 'supplements', 'obligatorySupplementCategory'];

    protected $appends = ['profile_img', 'media_links', 'supplements_details'];
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

    // the method used to get the profile of item
    public function getProfileImgAttribute(){
        if($this->media_links){
            $link = $this->media_links[0];
        }else {
            $link = Storage::url('items/default.png');
        }
        return $link;
    }

    public function scopeAvailable($query){
        $query->where('is_available', 1);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function supplements(){
        return $this->belongsToMany(Supplement::class, 'items_has_supplements', 'item_id', 'supplement_id');
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'items_has_supplements', 'supplement_id', 'item_id');
    }

    public function obligatorySupplementCategory(){
        return $this->belongsToMany(Category::class, 'obligatory_supplements_categories', 'item_id', 'category_id');
    }

    public function setSupplementsAttribute($value){
		if($this->id){
			return $this->supplements()->sync($value);;
		}
    }

    public function setObligatoryCategoriesAttribute($value){
		if($this->id){
			return $this->obligatorySupplementCategory()->sync($value);;
		}
    }

    public function setIsAvailableAttribute($value){
        if($value == 'on'){
            $this->attributes['is_available'] = true;
        }else{
            $this->attributes['is_available'] = false;
        }
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

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getSupplementsDetailsAttribute(){
        $categories = $this->supplements->pluck('category')->unique();
        $supplements_details = [];
        foreach($categories as $category){
            $required = $this->obligatorySupplementCategory->contains($category) ? true : false;
            array_push($supplements_details, [ 'category' => $category, 'required' => $required, 'items' => $this->supplements->where('category_id', $category->id)->values() ]);
        }
        return $supplements_details;
    }

    public function orderLines(){
        return $this->morphMany(OrderLine::class, 'model');
    }
}
