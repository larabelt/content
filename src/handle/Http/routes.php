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
        Route::get('handles/{id}', Handle\Http\Controllers\Api\HandlesController::class . '@show');
        Route::put('handles/{id}', Handle\Http\Controllers\Api\HandlesController::class . '@update');
        Route::delete('handles/{id}', Handle\Http\Controllers\Api\HandlesController::class . '@destroy');
        Route::get('handles', Handle\Http\Controllers\Api\HandlesController::class . '@index');
        Route::post('handles', Handle\Http\Controllers\Api\HandlesController::class . '@store');
    }
);