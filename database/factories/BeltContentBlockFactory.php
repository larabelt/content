<?php

$factory->define(Belt\Content\Block::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
        'template' => 'default',
        'body' => $faker->paragraphs(3, true),
    ];
});