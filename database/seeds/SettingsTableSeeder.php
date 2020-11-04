<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key'   => 'service_zone_radius', 'value' => '30'],
            ['key'   => 'site_language_code', 'value' => 'fr-FR'],
            ['key'   => 'shipping_fee', 'value' => '300'],
            ['key'   => 'max_simultaneous_shipments', 'value' => '3'],
            ['key'   => 'ubereats_fee_percent', 'value' => '2'],
            ['key'   => 'site_email', 'value' => 'contact@ubereats.com'],
            ['key'   => 'service_zone_longitude', 'value' => '0'],
            ['key'   => 'service_zone_latitude', 'value' => '0'],
            ['key'   => 'site_phone_number', 'value' => ''],
            ['key'   => 'site_keywords', 'value' => implode(', ', ['store', 'restaurant', 'e-commerce', 'shopping'])],
            // ['key'   => 'site_currency_code', 'value' => 'XAF'],
            ['key'   => 'site_title', 'value' => 'Manage your shop or restaurant every where']
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], [
                'key'   => $setting['key'],
                'value' => $setting['value'],
            ]);
        }
    }
}
