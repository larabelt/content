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
    Route::get('page/{slug}', Page\Http\Controllers\Front\PagesController::class . '@show');
});