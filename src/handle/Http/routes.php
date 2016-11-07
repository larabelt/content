<?php

use Ohio\Content\Handle;

/**
 * API
 */
Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {
        Route::get('/handles/{id}', Handle\Http\Controllers\ApiController::class . '@show');
        Route::put('/handles/{id}', Handle\Http\Controllers\ApiController::class . '@update');
        Route::delete('/handles/{id}', Handle\Http\Controllers\ApiController::class . '@destroy');
        Route::get('/handles', Handle\Http\Controllers\ApiController::class . '@index');
        Route::post('/handles', Handle\Http\Controllers\ApiController::class . '@store');
    }
);