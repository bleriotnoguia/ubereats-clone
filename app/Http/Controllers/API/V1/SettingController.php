<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\PaymentMethod;
use App\Models\Setting;
use DB;

class SettingController extends BaseController
{
    public function list()
    {
        $setting = array();
        $setting['currency_code'] = env('CURRENCY_CODE');
        $setting['paypal_client_id'] = env('PAYPAL_CLIENT_ID');
        $setting['paypal_sandbox'] = env('PAYPAL_SANBOX');
        $setting['stripe_key'] = env('STRIPE_KEY');
        $setting['google_map_api_key'] = env('GOOGLE_MAP_API_KEY');
        $setting['one_signal_key'] = env('ONE_SIGNAL_KEY');
        $setting['one_signal_sender_id'] = env('ONE_SIGNAL_SENDER_ID');

        $setting = Setting::all()->pluck('value', 'key')->toArray() + $setting;

        return $this->sendResponse($setting, 'Settings successfully retrieved !');
    }

    public function getTerms(){
        $terms_of_use = Setting::where('key', 'terms_of_use')->first();
        return $this->sendResponse($terms_of_use, 'Terms of use successfully retrieved');
    }

    public function getPrivacy(){
        $privacy_policy = Setting::where('key', 'privacy_policy')->first();
        return $this->sendResponse($privacy_policy, 'Privacy policy successfully retrieved');
    }

    public function getPaymentMethods(){
        $payment_methods = PaymentMethod::Activated()->get();
        return $this->sendResponse($payment_methods->toArray(), 'Payment methods successfully retrieved !');
    }
}
