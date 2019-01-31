<?php

use Belt\Core\Helpers\FactoryHelper;

$factory->define(Belt\Content\Attachment::class, function (Faker\Generator $faker, $attributes) {

    $result = [];
    if (!array_get($attributes, 'name')) {
        $helper = (new FactoryHelper())->loadImages();
        $result = $helper->uploadImage($helper->getRandomImage());
    }

    return array_merge($result, [
        'title' => $faker->words(rand(3, 7), true),
        'note' => $faker->paragraphs(rand(1, 3), true),
    ], $attributes);

});