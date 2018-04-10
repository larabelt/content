<?php

use Illuminate\Support\Str;

$factory->define(Belt\Content\Post::class, function (Faker\Generator $faker) {
    return [
        'is_active' => $faker->boolean(),
        'name' => Str::title($faker->words(3, true)),
        'template' => 'default',
        'body' => $faker->paragraphs(3, true),
        'meta_title' => $faker->words(3, true),
        'meta_description' => $faker->paragraphs(1, true),
        'meta_keywords' => $faker->words(12, true),
        'post_at' => $faker->dateTimeBetween('-3 days', '+3 days'),
        'source_url' => $faker->url,
        'source_name' => Str::title($faker->words(random_int(2, 4), true)),
    ];
});