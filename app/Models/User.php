<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gabievi\Promocodes\Traits\Rewardable;
use \Calebporzio\Onboard\GetsOnboarded;
use App\Traits\HasWallet;
use Storage;
use Avatar;
use Cache;

class User extends Authenticatable  implements HasMedia, MustVerifyEmail
{
    use Notifiable, HasApiTokens, HasMediaTrait, HasRoles, SoftDeletes, Rewardable, GetsOnboarded, HasWallet;

    const SUPER_ADMIN = 'super-admin';

    const SHOP_ADMIN = 'shop-admin';

    /**
     * The attribute for SoftDeletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number', 'password', 'is_enable', 'active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'media', 'activation_token', 'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['profile_img', 'media_links', 'avatar', 'full_name', 'location', 'country_name', 'city_name'];

    public function getLocationAttribute(){
        if ($this->address && $this->address->gmap_address) {
            return $this->address->gmap_address['formatted_address'];
        }
    }

    public function getCountryNameAttribute(){
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

    public function getCityNameAttribute(){
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

    // the method used to get the profile of user
    public function getProfileImgAttribute(){
        if($this->getMedia('image')->first()){
            $arrayLinks = explode("public", $this->getMedia('image')->first()->getPath());
            $link = Storage::url($arrayLinks[count($arrayLinks) - 1]);
        }else {
            $link = $this->avatar;
        }
        return $link;
    }

    public function scopeShipper($query){
        $query->whereHas('roles', function(Builder $query){
            $query->where('name', 'shipper');
        });
    }

    public function scopeCustomers($query){
        $query->whereHas('roles', function(Builder $query){
            $query->where('name', 'customer');
        });
    }

    public function scopeShopAdmin($query){
        $query->whereHas('roles', function(Builder $query){
            $query->where('name', 'shop-admin');
        });
    }

    // Pour la disponibilité des livreurs
    public function scopeAvailable($query){
        $query->where('available', 1);
    }
    
    // Get the avatar
    public function getAvatarAttribute(){
        return Storage::url('users/'.$this->id.'/avatar.png');
    }

    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }

    public function getLastNameAttribute($value){
        return ucfirst($value);
    }

    public function getNameAttribute(){
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    public function getFullNameAttribute(){
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    public function getStatusAttribute(){
            if($this->is_enable){
                return 'not blocked';
            }else{
                return 'blocked';
            }
    }

    public function getStatusHtmlAttribute(){
        switch($this->status){
            case 'blocked':
            case 'unactivited': 
                $type = 'danger';
                break;
            case 'activated':
            case 'not blocked':
                $type = 'success';
                break;
            default:
                $type = 'default';
        }
        return '<span class="label label-'.$type.'">'.__($this->status).'</span>';
    }

    public function setRolesAttribute($value){
        if(Auth::user()->isSuperAdmin()){
            if(!empty($value)){
                $this->assignRole($value);
            }
        }
    }

    // Relation between user and restaurant
    public function restaurant(){
        return $this->hasOne(Restaurant::class);
    }

    public function shippings(){
        return $this->hasMany(Shipping::class);
    }

    public function notations(){
        return $this->hasMany(Notation::class);
    }

    public function payments(){
        return $this->hasMany(Payments::class);
    }

    public function metas(){
        return $this->hasMany(Meta::class);
    }

    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }

    // Check if user has super-admin role
    public function isSuperAdmin(){
        return $this->hasrole(self::SUPER_ADMIN);
    }

    // Check if user has shop-admin role
    public function isShopAdmin(){
        return $this->hasrole(self::SHOP_ADMIN);
    }

    // Check if user has shipper role
    public function isShipper(){
        return $this->hasrole('shipper');
    }

    // Check if user has customer role
    public function isCustomer(){
        return $this->hasrole('customer');
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

    public function getRoleAttribute(){
        if($this->getRoleNames()->count() > 0){
            foreach($this->getRoleNames() as $role){
                return __($role);
            }
        }else{
            return __('Customer');
        }
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function onesignals(){
        return $this->hasMany(Onesignal::class);
    }

    public function tracking(){
        return $this->hasOne(Tracking::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}
