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
use Ohio\Storage\File;

$factory->define(Ohio\Content\Tout::class, function (Faker\Generator $faker) {

    $file = factory(File::class)->create();

    return [
        'file_id' => $file ? $file->id : null,
        'name' => $faker->words(3, true),
        'heading' => $faker->words(random_int(1, 5), true),
        'body' => $faker->words(random_int(5, 20), true),
        'btn_text' => $faker->randomElement(['click here', 'click', 'learn more']),
        'btn_url' => $faker->url,
    ];
});