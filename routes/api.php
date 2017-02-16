<?php

use Belt\Content\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {

        # blocks
        Route::get('blocks/{id}', Api\BlocksController::class . '@show');
        Route::put('blocks/{id}', Api\BlocksController::class . '@update');
        Route::delete('blocks/{id}', Api\BlocksController::class . '@destroy');
        Route::get('blocks', Api\BlocksController::class . '@index');
        Route::post('blocks', Api\BlocksController::class . '@store');

        # handles
        Route::get('handles/{id}', Api\HandlesController::class . '@show');
        Route::put('handles/{id}', Api\HandlesController::class . '@update');
        Route::delete('handles/{id}', Api\HandlesController::class . '@destroy');
        Route::get('handles', Api\HandlesController::class . '@index');
        Route::post('handles', Api\HandlesController::class . '@store');

        # pages
        Route::get('pages/{id}', Api\PagesController::class . '@show');
        Route::put('pages/{id}', Api\PagesController::class . '@update');
        Route::delete('pages/{id}', Api\PagesController::class . '@destroy');
        Route::get('pages', Api\PagesController::class . '@index');
        Route::post('pages', Api\PagesController::class . '@store');

        # sections
        Route::get('sections/{id}', Api\SectionsController::class . '@show');
        Route::put('sections/{id}', Api\SectionsController::class . '@update');
        Route::delete('sections/{id}', Api\SectionsController::class . '@destroy');
        Route::get('sections', Api\SectionsController::class . '@index');
        Route::post('sections', Api\SectionsController::class . '@store');

        # touts
        Route::get('touts/{id}', Api\ToutsController::class . '@show');
        Route::put('touts/{id}', Api\ToutsController::class . '@update');
        Route::delete('touts/{id}', Api\ToutsController::class . '@destroy');
        Route::get('touts', Api\ToutsController::class . '@index');
        Route::post('touts', Api\ToutsController::class . '@store');
    }
);
