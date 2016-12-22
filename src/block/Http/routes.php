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
        Route::get('blocks/{id}', Block\Http\Controllers\Api\BlocksController::class . '@show');
        Route::put('blocks/{id}', Block\Http\Controllers\Api\BlocksController::class . '@update');
        Route::delete('blocks/{id}', Block\Http\Controllers\Api\BlocksController::class . '@destroy');
        Route::get('blocks', Block\Http\Controllers\Api\BlocksController::class . '@index');
        Route::post('blocks', Block\Http\Controllers\Api\BlocksController::class . '@store');
    }
);