<?php

use Ohio\Content\Page;

/**
 * API
 */
Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['ohio.api']
],
    function () {
        Route::get('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@show');
        Route::put('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@update')->middleware('ohio.api.admin');
        Route::delete('pages/{id}', Page\Http\Controllers\Api\PagesController::class . '@destroy')->middleware('ohio.api.admin');
        Route::get('pages', Page\Http\Controllers\Api\PagesController::class . '@index')->middleware('ohio.api.admin');
        Route::post('pages', Page\Http\Controllers\Api\PagesController::class . '@store')->middleware('ohio.api.admin');
    }
);

/**
 * Front
 */
Route::group(['middleware' => ['ohio.web']], function () {
    Route::get('page/{slug}', Page\Http\Controllers\Front\PagesController::class . '@show');
});