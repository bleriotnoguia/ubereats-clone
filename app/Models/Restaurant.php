<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Storage;

class Restaurant extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    const TIME_INTEVAL = '00:30:00';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "shipping_fee", "name", "description", "deliveries_time", "preparation_time", "cuisines", "user_id", "active", "is_open", "is_merchant"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "is_merchant" => "boolean",
        'is_open' => 'boolean'
    ];

    protected $appends = ['profile_img', 'media_links', 'location', 'country_name', 'city_name', 'email'];

    protected $hidden = ['media'];

    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    // the method used to get the profile of restaurant
    public function getProfileImgAttribute()
    {
        if ($this->media_links) {
            $link = $this->media_links[0];
        } else {
            $link = Storage::url('restaurants/default.png');
        }
        return $link;
    }

    public function getLocationAttribute()
    {
        if ($this->address && $this->address->gmap_address) {
            return $this->address->gmap_address['formatted_address'];
        }
    }

    public function getCountryNameAttribute()
    {
        if ($this->address && $this->address->gmap_address) {
            foreach($this->address->gmap_address['address_components'] as $key => $val){
                foreach($val['types'] as $key1 => $val1){
                    if($val1 == 'country'){
                        return $val['long_name'];
                    }
                }
            }
        }
    }

    public function getPostalCodeNameAttribute()
    {
        if ($this->address && $this->address->gmap_address) {
            foreach($this->address->gmap_address['address_components'] as $key => $val){
                foreach($val['types'] as $key1 => $val1){
                    if($val1 == 'postal_code'){
                        return $val['long_name'];
                    }
                }
            }
        }
        return null;
    }

    public function getLatitudeAttribute(){
        if ($this->address && $this->address->gmap_address) {
            return $this->address->gmap_address['geometry']['location']['lat'];
        }
    }

    public function getLongitudeAttribute(){
        if ($this->address && $this->address->gmap_address) {
            return $this->address->gmap_address['geometry']['location']['lng'];
        }
    }

    public function getCityNameAttribute()
    {
        if ($this->address && $this->address->gmap_address) {
            foreach($this->address->gmap_address['address_components'] as $key => $val){
                foreach($val['types'] as $key1 => $val1){
                    if($val1 == 'locality'){
                        return $val['long_name'];
                    }
                }
            }
        }
    }

    public function getTypeAttribute()
    {
        if($this->is_merchant){
            return 'commerce';
        }
        return 'restaurant';
    }

    public function setShippingFeeAttribute($value){
        if(Auth::user()->isSuperAdmin()){
            $this->attributes['shipping_fee'] = $value;
        }
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getPhoneNumberAttribute()
    {
        return $this->user->phone_number;
    }

    public function getDeliveriesTimeAttribute($value)
    {
        $end_interv = Carbon::createFromFormat('H:i:s',self::TIME_INTEVAL)
                                ->addMinutes(Carbon::createFromFormat('H:i:s',$value)
                                ->diffInMinutes(Carbon::createFromFormat('H:i:s','00:00:00')))
                                ->format('H:i');
        $start_interv = Carbon::createFromFormat('H:i:s',$value)
                                ->format('H:i');
        return $start_interv.' - '.$end_interv;
    }

    public function getPreparationTimeAttribute($value){
        return Carbon::createFromFormat('H:i:s',$value)->format('H:i');
    }

    public function getIsOpenAttribute($value){
        $programme = $this->programmes()->where('day_id', date('N'))->first();
        if($programme){
            $is_between_open_time = strtotime($programme->open_time) <= strtotime(date('H:i:s')) && strtotime(date('H:i:s')) < strtotime($programme->close_time);
            return $value && $is_between_open_time;
        }
        return false;
    }

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class, 'restaurants_has_cuisines', 'restaurant_id', 'cuisine_id');
    }

    public function scopeActivated($query)
    {
        $query->where('active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* Retour de la liste des clients en utilisant la table orders coe pivot 
     * utiliser ->unique() pour retirer les valeurs duppliquers
     */
    public function customers()
    {
        return $this->belongsToMany(User::class, 'orders', 'restaurant_id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function supplements()
    {
        return $this->hasMany(Supplement::class);
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function promocodes()
    {
        return $this->hasMany(Promocode::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function notations()
    {
        return $this->hasManyThrough(Notation::class, Order::class, 'restaurant_id', 'notable_id')->where('notable_type', '=', 'App\Models\Order');
    }

    public function setCuisinesAttribute($value)
    {
        if ($this->id) {
            return $this->cuisines()->sync($value);
        }
    }

    public function setActiveAttribute($value){
        if($value == 'on'){
            $this->attributes['active'] = true;
        }else{
            $this->attributes['active'] = false;
        }
    }

    public function setIsOpenAttribute($value){
        if($value === 'on' || $value == 1){
            $this->attributes['is_open'] = true;
        }else{
            $this->attributes['is_open'] = false;
        }
    }

    public function getMediaLinksAttribute()
    {
        $mediaLinks = [];
        // dd($this->getMedia('image'));
        foreach ($this->getMedia('image') as $key => $media) {
            $urlParts = explode('public', $media->getPath());
            $filePath = "storage" . $urlParts[sizeof($urlParts) - 1];
            array_push($mediaLinks, $filePath);
        }
        return $mediaLinks;
    }

}
