<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'restaurant_id' => ''
    ];
});

$factory->state(Category::class, 'items', function (){
    return [
        'type' => 'items'
    ];
});

$factory->state(Category::class, 'supplements', function (){
    return [
        'type' => 'supplements'
    ];
});