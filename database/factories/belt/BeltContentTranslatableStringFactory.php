<?php

use Illuminate\Support\Str;

$factory->define(Belt\Content\TranslatableString::class, function (Faker\Generator $faker) {
    return [
        'value' => Str::title($faker->words(rand(1, 4), true)),
    ];
});