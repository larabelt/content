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
        Route::get('/tags/{id}', Tag\Http\Controllers\ApiController::class . '@show');
        Route::put('/tags/{id}', Tag\Http\Controllers\ApiController::class . '@update');
        Route::delete('/tags/{id}', Tag\Http\Controllers\ApiController::class . '@destroy');
        Route::get('/tags', Tag\Http\Controllers\ApiController::class . '@index');
        Route::post('/tags', Tag\Http\Controllers\ApiController::class . '@store');
    }
);

/**
 * Front
 */
Route::group(['middleware' => ['web']], function () {
    Route::get('tag/{slug}', Tag\Http\Controllers\FrontController::class . '@show');
});