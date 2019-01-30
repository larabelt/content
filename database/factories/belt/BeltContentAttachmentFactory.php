<?php

use Belt\Core\Helpers\FactoryHelper;
use Belt\Content\Adapters\AdapterFactory;

$factory->define(Belt\Content\Attachment::class, function (Faker\Generator $faker, $attributes) {

    $result = [];
    if (!array_get($attributes, 'name')) {
        $adapter = AdapterFactory::up();
        FactoryHelper::setAdapter($adapter);
        FactoryHelper::setImages();
        $result = FactoryHelper::uploadImage(FactoryHelper::getRandomImage());
    }

    return array_merge($result, [
        'title' => $faker->words(rand(3, 7), true),
        'note' => $faker->paragraphs(rand(1, 3), true),
    ], $attributes);

});