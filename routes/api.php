<?php

use Ohio\Content;

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
    'middleware' => ['web', 'auth.basic', 'api']
],
    function () {

        # blocks
        Route::get('blocks/{id}', Content\Http\Controllers\Api\BlocksController::class . '@show');
        Route::put('blocks/{id}', Content\Http\Controllers\Api\BlocksController::class . '@update');
        Route::delete('blocks/{id}', Content\Http\Controllers\Api\BlocksController::class . '@destroy');
        Route::get('blocks', Content\Http\Controllers\Api\BlocksController::class . '@index');
        Route::post('blocks', Content\Http\Controllers\Api\BlocksController::class . '@store');

        # handles
        Route::get('handles/{id}', Content\Http\Controllers\Api\HandlesController::class . '@show');
        Route::put('handles/{id}', Content\Http\Controllers\Api\HandlesController::class . '@update');
        Route::delete('handles/{id}', Content\Http\Controllers\Api\HandlesController::class . '@destroy');
        Route::get('handles', Content\Http\Controllers\Api\HandlesController::class . '@index');
        Route::post('handles', Content\Http\Controllers\Api\HandlesController::class . '@store');

        # pages
        Route::get('pages/{id}', Content\Http\Controllers\Api\PagesController::class . '@show');
        Route::put('pages/{id}', Content\Http\Controllers\Api\PagesController::class . '@update');
        Route::delete('pages/{id}', Content\Http\Controllers\Api\PagesController::class . '@destroy');
        Route::get('pages', Content\Http\Controllers\Api\PagesController::class . '@index');
        Route::post('pages', Content\Http\Controllers\Api\PagesController::class . '@store');

        # sections
        Route::get('sections/{id}', Content\Http\Controllers\Api\SectionsController::class . '@show');
        Route::put('sections/{id}', Content\Http\Controllers\Api\SectionsController::class . '@update');
        Route::delete('sections/{id}', Content\Http\Controllers\Api\SectionsController::class . '@destroy');
        Route::get('sections', Content\Http\Controllers\Api\SectionsController::class . '@index');
        Route::post('sections', Content\Http\Controllers\Api\SectionsController::class . '@store');

        # tags
        Route::get('tags/{id}', Content\Http\Controllers\Api\TagsController::class . '@show');
        Route::put('tags/{id}', Content\Http\Controllers\Api\TagsController::class . '@update');
        Route::delete('tags/{id}', Content\Http\Controllers\Api\TagsController::class . '@destroy');
        Route::get('tags', Content\Http\Controllers\Api\TagsController::class . '@index');
        Route::post('tags', Content\Http\Controllers\Api\TagsController::class . '@store');

        # taggables
        Route::group(['prefix' => 'taggables/{taggable_type}/{taggable_id}'], function () {
            Route::get('{id}', Content\Http\Controllers\Api\TaggablesController::class . '@show');
            Route::delete('{id}', Content\Http\Controllers\Api\TaggablesController::class . '@destroy');
            Route::get('', Content\Http\Controllers\Api\TaggablesController::class . '@index');
            Route::post('', Content\Http\Controllers\Api\TaggablesController::class . '@store');
        });

        # touts
        Route::get('touts/{id}', Content\Http\Controllers\Api\ToutsController::class . '@show');
        Route::put('touts/{id}', Content\Http\Controllers\Api\ToutsController::class . '@update');
        Route::delete('touts/{id}', Content\Http\Controllers\Api\ToutsController::class . '@destroy');
        Route::get('touts', Content\Http\Controllers\Api\ToutsController::class . '@index');
        Route::post('touts', Content\Http\Controllers\Api\ToutsController::class . '@store');
    }
);
