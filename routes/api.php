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
    'middleware' => ['web', 'auth', 'api']
],
    function () {

        # blocks
        Route::get('blocks/{id}', Content\Block\Http\Controllers\Api\BlocksController::class . '@show');
        Route::put('blocks/{id}', Content\Block\Http\Controllers\Api\BlocksController::class . '@update');
        Route::delete('blocks/{id}', Content\Block\Http\Controllers\Api\BlocksController::class . '@destroy');
        Route::get('blocks', Content\Block\Http\Controllers\Api\BlocksController::class . '@index');
        Route::post('blocks', Content\Block\Http\Controllers\Api\BlocksController::class . '@store');

        # handles
        Route::get('handles/{id}', Content\Handle\Http\Controllers\Api\HandlesController::class . '@show');
        Route::put('handles/{id}', Content\Handle\Http\Controllers\Api\HandlesController::class . '@update');
        Route::delete('handles/{id}', Content\Handle\Http\Controllers\Api\HandlesController::class . '@destroy');
        Route::get('handles', Content\Handle\Http\Controllers\Api\HandlesController::class . '@index');
        Route::post('handles', Content\Handle\Http\Controllers\Api\HandlesController::class . '@store');

        # pages
        Route::get('pages/{id}', Content\Page\Http\Controllers\Api\PagesController::class . '@show');
        Route::put('pages/{id}', Content\Page\Http\Controllers\Api\PagesController::class . '@update');
        Route::delete('pages/{id}', Content\Page\Http\Controllers\Api\PagesController::class . '@destroy');
        Route::get('pages', Content\Page\Http\Controllers\Api\PagesController::class . '@index');
        Route::post('pages', Content\Page\Http\Controllers\Api\PagesController::class . '@store');

        # tags
        Route::get('tags/{id}', Content\Tag\Http\Controllers\Api\TagsController::class . '@show');
        Route::put('tags/{id}', Content\Tag\Http\Controllers\Api\TagsController::class . '@update');
        Route::delete('tags/{id}', Content\Tag\Http\Controllers\Api\TagsController::class . '@destroy');
        Route::get('tags', Content\Tag\Http\Controllers\Api\TagsController::class . '@index');
        Route::post('tags', Content\Tag\Http\Controllers\Api\TagsController::class . '@store');

        # taggables
        Route::group(['prefix' => 'taggables/{taggable_type}/{taggable_id}'], function () {
            Route::get('{id}', Content\Tag\Http\Controllers\Api\TaggablesController::class . '@show');
            Route::delete('{id}', Content\Tag\Http\Controllers\Api\TaggablesController::class . '@destroy');
            Route::get('', Content\Tag\Http\Controllers\Api\TaggablesController::class . '@index');
            Route::post('', Content\Tag\Http\Controllers\Api\TaggablesController::class . '@store');
        });
    }
);
