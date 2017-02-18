<?php

$factory->define(Belt\Content\Handle::class, function (Faker\Generator $faker) {

    $types = ['pages'];

    return [
        'handleable_id' => $faker->randomDigit,
        'handleable_type' => $faker->randomElement($types),
        'url' => sprintf('/%s', $faker->slug),
        'delta' => 1,
    ];
});