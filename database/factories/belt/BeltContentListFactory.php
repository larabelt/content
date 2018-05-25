<?php

$factory->define(Belt\Content\Lyst::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
        'meta_title' => $faker->words(3, true),
        'meta_description' => $faker->paragraphs(1, true),
        'meta_keywords' => $faker->words(12, true),
    ];
});