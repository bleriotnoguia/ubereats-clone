<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => explode(" ", $faker->name)[0],
        'last_name' => explode(" ", $faker->name)[1],
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(60),
        'activation_token' => str_random(60),
        'roles' => 'customer',
        'active' => false
    ];
});

$factory->state(User::class, 'shop-admin', function() {
    return [
        'roles' => 'shop-admin',
    ];
});

$factory->state(User::class, 'shipper', function(){
    return [
        'roles' => 'shipper',
    ];
});