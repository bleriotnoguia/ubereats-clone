<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    static $vars;
    public $timestamps = false;

    public static function get( $k ){
        if($k == 'service_zone_longitude'){
            $service_zone_gmap_address = self::getZoneMapAddress();
            if($service_zone_gmap_address){
                return !empty($service_zone_gmap_address) ? json_decode($service_zone_gmap_address)->geometry->location->lng : null;
            }else{
                return 4.906005778768538;
            }
        }else if($k == 'service_zone_latitude'){
            $service_zone_gmap_address = self::getZoneMapAddress();
            if($service_zone_gmap_address){
                return !empty($service_zone_gmap_address) ? json_decode($service_zone_gmap_address)->geometry->location->lat : null;
            }else{
                return 11.767480468750016;
            }
        }else{
            $setting = self::all()->pluck('value', 'key')->toArray();
            return isset($setting[$k]) ? $setting[$k] : 'error';
        }
    }

    static function getServiceCountry(){
        foreach(json_decode(self::getZoneMapAddress())->address_components as $key => $val){
            foreach($val->types as $key1 => $val1){
                if($val1 == 'country'){
                    return $val->long_name;
                }
            }
        }
    }

    static function getServicePostalCode(){
        foreach(json_decode(self::getZoneMapAddress())->address_components as $key => $val){
            foreach($val->types as $key1 => $val1){
                if($val1 == 'postal_code'){
                    return $val->long_name;
                }
            }
        }
    }

    static function getServiceAddress(){
        return json_decode(self::getZoneMapAddress())->formatted_address;
    }

    static function getZoneMapAddress(){
        $zone_gmap_address = self::where('key', 'service_zone_gmap_address')->first();
        if($zone_gmap_address){
            return $zone_gmap_address->value;
        }
    }
}
