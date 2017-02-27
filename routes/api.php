<?php

use Belt\Core\Http\Controllers\Api\ConfigController;
use Belt\Content\Http\Controllers\Api;

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

        # config
        Route::get('config/belt.templates/{key?}', ConfigController::class . '@show');

        # handles
        Route::group([
            'prefix' => '{handleable_type}/{handleable_id}/handles',
            'middleware' => 'request.injections:handleable_type,handleable_id'
        ], function () {
            Route::get('{id}', Api\HandlesController::class . '@show');
            Route::delete('{id}', Api\HandlesController::class . '@destroy');
            Route::get('', Api\HandlesController::class . '@index');
            Route::post('', Api\HandlesController::class . '@store');
        });

        # pages
        Route::get('pages/{id}', Api\PagesController::class . '@show');
        Route::put('pages/{id}', Api\PagesController::class . '@update');
        Route::delete('pages/{id}', Api\PagesController::class . '@destroy');
        Route::get('pages', Api\PagesController::class . '@index');
        Route::post('pages', Api\PagesController::class . '@store');

        # sections
        Route::get('sections/{id}/preview', Api\SectionsController::class . '@preview');
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
