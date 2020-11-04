<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomElement([400, 550, 600]), 
        'description'=> $faker->text,
        'menu_id' => '',
        'category_id' => '',
        'restaurant_id' => ''
    ];
});
