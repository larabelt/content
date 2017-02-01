<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Ohio\Content\Page;

$factory->define(Ohio\Content\Section::class, function (Faker\Generator $faker) {

    $page = Page::inRandomOrder()->first(['pages.id']);

    return [
        'page_id' => $page ? $page->id : null,
        'template' => 'default',
        'class' => $faker->words(random_int(1, 5), true),
        'header' => $faker->paragraphs(3, true),
        'body' => $faker->paragraphs(3, true),
        'footer' => $faker->paragraphs(3, true),
    ];
});