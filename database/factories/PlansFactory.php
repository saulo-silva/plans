<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use SauloSilva\Plans\Models\Plan;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(200),
        'started_date' => now(),
        'completed_date' => null,
        'total' => $faker->randomFloat(null, 0, 300),
        'destination' => $faker->randomElement(['SAULO', 'RUTH', 'SOFIA']),
        'type' => $faker->randomElement(['DREAM', 'ACQUISITION', 'DEBT', 'WISH']),
        'status' => $faker->randomElement(['WAITING', 'IN_PROGRESS', 'PAUSE', 'COMPLETED', 'FAILED']),
        'priority' => $faker->randomElement(['HIGH', 'NORMAL', 'LOW'])
    ];
});
