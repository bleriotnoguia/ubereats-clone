<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['lundi', 'mardi', 'mercredi', 'vendredi', 'samedi', 'dimanche'];
        foreach ($days as $day) {
            DB::table('days')->insert(['name' => $day]);
        }
    }
}
