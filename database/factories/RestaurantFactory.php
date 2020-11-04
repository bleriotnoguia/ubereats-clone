<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Restaurant;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name' => $faker->word.' shop',
        'description' => $faker->text(100),
        'deliveries_time' => '00:00:00',
        'is_merchant' => $faker->randomElement([1, 0]),
        'user_id' => factory(User::class)->state('shop-admin')->create()->id,
    ];
});

$factory->state(Restaurant::class, 'restaurant', function() {
    return [
        'is_merchant' => false,
        'preparation_time' => '00:00:00',
    ];
});
