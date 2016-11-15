<?php

use Ohio\Content\Block;

/**
 * API
 */
Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {
        Route::get('/blocks/{id}', Block\Http\Controllers\ApiController::class . '@show');
        Route::put('/blocks/{id}', Block\Http\Controllers\ApiController::class . '@update');
        Route::delete('/blocks/{id}', Block\Http\Controllers\ApiController::class . '@destroy');
        Route::get('/blocks', Block\Http\Controllers\ApiController::class . '@index');
        Route::post('/blocks', Block\Http\Controllers\ApiController::class . '@store');
    }
);

/**
 * Front
 */
Route::group(['middleware' => ['web']], function () {
    Route::get('block/{slug}', Block\Http\Controllers\FrontController::class . '@show');
});