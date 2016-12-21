<?php

use Ohio\Content\Page;

/**
 * API
 */
Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {

        Route::group(['prefix' => 'pages/{page_id}/tags'], function () {
            Route::get('', Page\Http\Controllers\Api\TagsController::class . '@index');
            Route::post('', Page\Http\Controllers\Api\TagsController::class . '@store');
            Route::get('{id}', Page\Http\Controllers\Api\TagsController::class . '@show');
            Route::delete('{id}', Page\Http\Controllers\Api\TagsController::class . '@destroy');
        });

        Route::get('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@show');
        Route::put('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@update');
        Route::delete('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@destroy');
        Route::get('pages', Page\Http\Controllers\Api\PagesController::class . '@index');
        Route::post('pages', Page\Http\Controllers\Api\PagesController::class . '@store');
    }
);

/**
 * Front
 */
Route::group(['middleware' => ['web']], function () {
    Route::get('page/{slug}', Page\Http\Controllers\FrontController::class . '@show');
});