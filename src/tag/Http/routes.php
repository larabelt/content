<?php

use Ohio\Content\Tag;

/**
 * API
 */
Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {
        Route::get('tags/{id}', Tag\Http\Controllers\Api\TagsController::class . '@show');
        Route::put('tags/{id}', Tag\Http\Controllers\Api\TagsController::class . '@update');
        Route::delete('tags/{id}', Tag\Http\Controllers\Api\TagsController::class . '@destroy');
        Route::get('tags', Tag\Http\Controllers\Api\TagsController::class . '@index');
        Route::post('tags', Tag\Http\Controllers\Api\TagsController::class . '@store');

        Route::group(['prefix' => 'taggables/{taggable_type}/{taggable_id}'], function () {
            Route::get('{id}', Tag\Http\Controllers\Api\TaggablesController::class . '@show');
            Route::delete('{id}', Tag\Http\Controllers\Api\TaggablesController::class . '@destroy');
            Route::get('', Tag\Http\Controllers\Api\TaggablesController::class . '@index');
            Route::post('', Tag\Http\Controllers\Api\TaggablesController::class . '@store');
        });
    }
);