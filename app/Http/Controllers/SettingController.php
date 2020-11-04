<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Session;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     if (Auth::user()->isSuperAdmin()) {
    //         $this->setEnvironmentValue($request->all());
    //         Session::flash('success', 'Les paramètres par défaut ont bien été modifiés');
    //         return redirect(route('setting.edit', 1));
    //     }
    //     return back();
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param \App\Models\Setting $setting
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Setting $setting)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editGeneralSetting()
    {
        if (Auth::user()->isSuperAdmin()) {
            $settings = Setting::all();
            return view('settings.general', compact('settings'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editSiteSetting()
    {
        if (Auth::user()->isSuperAdmin()) {
            $settings = Setting::all()->pluck('value','key')->toArray();
            if (isset($settings['service_zone_gmap_address'])) {
                $settings['service_zone_address'] = Setting::getServiceAddress();
                $settings['service_zone_country'] = Setting::getServiceCountry();
                $settings['service_zone_postal_code'] = Setting::getServicePostalCode();
            }
            return view('settings.site', compact('settings'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPrivacy()
    {
        if (Auth::user()->isSuperAdmin()) {
            $privacy_policy = Setting::where('key', 'privacy_policy')->first();
            return view('settings.privacy', compact('privacy_policy'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editTerms()
    {
        if (Auth::user()->isSuperAdmin()) {
            $terms_of_use = Setting::where('key', 'terms_of_use')->first();
            return view('settings.terms', compact('terms_of_use'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateGeneralSetting(Request $request)
    {

        if (Auth::user()->isSuperAdmin()) {
            $this->setEnvironmentValue($request->all());
            Session::flash('success', 'Les paramètres par défaut ont bien été modifiés');
            return redirect(route('settings.general', $request->all()));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateSiteSetting(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            foreach($request->except(['_token', '_method']) as $key => $value){
                $setting = Setting::where('key', $key)->first();
                if(!$setting){
                    $setting = new Setting();
                    $setting->key = $key;
                    $setting->value = $value;
                    $setting->save();
                }else{
                    $setting->update(['value' => $value]);
                }
            }
            $settings = Setting::all()->pluck('value','key')->toArray();
            Session::flash('success', 'Les paramètres par défaut du site ont bien été modifiés');
            return redirect(route('settings.site', $settings));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function storePrivacy(Request $request){
        $privacy_policy = Setting::where('key', 'privacy_policy')->first();
        if(!$privacy_policy){
            $privacy_policy = new Setting();
            $privacy_policy->key = 'privacy_policy';
            $privacy_policy->value = $request->privacy;
            $privacy_policy->save();
        }else{
            $privacy_policy->update(['value' => $request->privacy]);
        }
        Session::flash('success', 'La politique de confidentialité a bien été modifiée');
        return redirect(route('settings.edit_privacy', $privacy_policy));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function storeTerms(Request $request){
        $terms_of_use = Setting::where('key', 'terms_of_use')->first();
        if(!$terms_of_use){
            $terms_of_use = new Setting();
            $terms_of_use->key = 'terms_of_use';
            $terms_of_use->value = $request->terms;
            $terms_of_use->save();
        }else{
            $terms_of_use->update(['value' => $request->terms]);
        }
        Session::flash('success', 'Les conditions génerales d\'utilisation ont bien été modifiée');
        return redirect(route('settings.edit_terms', $terms_of_use));
    }

    public function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                if ($envKey != '_method' && $envKey != '_token') {
                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;

    }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param \App\Models\Setting $setting
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Setting $setting)
    // {
    //     //
    // }
}
