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
        Route::get('/pages/{id}', Page\Http\Controllers\ApiController::class . '@show');
        Route::put('/pages/{id}', Page\Http\Controllers\ApiController::class . '@update');
        Route::delete('/pages/{id}', Page\Http\Controllers\ApiController::class . '@destroy');
        Route::get('/pages', Page\Http\Controllers\ApiController::class . '@index');
        Route::post('/pages', Page\Http\Controllers\ApiController::class . '@store');
    }
);