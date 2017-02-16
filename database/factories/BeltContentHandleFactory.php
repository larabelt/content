<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Belt\Content\Handle::class, function (Faker\Generator $faker) {

    $types = ['pages'];

    return [
        'handleable_id' => $faker->randomDigit,
        'handleable_type' => $faker->randomElement($types),
        'url' => sprintf('/%s', $faker->slug),
        'delta' => 1,
    ];
});