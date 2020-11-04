<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Supplement;
use Faker\Generator as Faker;

$factory->define(Supplement::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomElement([400, 550, 600]), 
        'description'=> $faker->text,
        'category_id' => '',
        'restaurant_id' => ''
    ];
});
