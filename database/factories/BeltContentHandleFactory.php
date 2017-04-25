<?php

$factory->define(Belt\Content\Handle::class, function (Faker\Generator $faker) {
    return [
        'url' => sprintf('/%s', $faker->slug),
        'hits' => rand(0, 9999),
    ];
});