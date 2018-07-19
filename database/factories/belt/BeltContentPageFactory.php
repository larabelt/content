<?php

use Illuminate\Support\Str;

$factory->define(Belt\Content\Page::class, function (Faker\Generator $faker) {
    return [
        'is_active' => $faker->boolean(),
        'name' => Str::title($faker->words(3, true)),
        'subtype' => 'default',
        'body' => $faker->paragraphs(3, true),
        'meta_title' => $faker->words(3, true),
        'meta_description' => $faker->paragraphs(1, true),
        'meta_keywords' => $faker->words(12, true),
    ];
});