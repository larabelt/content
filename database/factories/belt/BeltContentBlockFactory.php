<?php

$factory->define(Belt\Content\Block::class, function (Faker\Generator $faker) {
    return [
        'subtype' => 'default',
        'name' => $faker->words(3, true),
        'heading' => $faker->words(3, true),
        'body' => $faker->paragraphs(3, true),
    ];
});