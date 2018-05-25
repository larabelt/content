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
        Route::get('config/belt.content.handles.responses/', ConfigController::class . '@show');
        Route::get('config/belt.templates/{key?}', ConfigController::class . '@show');

        # handles
        Route::get('handles/{handle}', Api\HandlesController::class . '@show');
        Route::put('handles/{handle}', Api\HandlesController::class . '@update');
        Route::delete('handles/{handle}', Api\HandlesController::class . '@destroy');
        Route::get('handles', Api\HandlesController::class . '@index');
        Route::post('handles', Api\HandlesController::class . '@store');

        # handleables
        Route::group([
            'prefix' => '{handleable_type}/{handleable_id}/handles',
            'middleware' => 'request.injections:handleable_type,handleable_id'
        ], function () {
            Route::get('{handle}', Api\HandleablesController::class . '@show');
            Route::put('{handle}', Api\HandleablesController::class . '@update');
            Route::delete('{handle}', Api\HandleablesController::class . '@destroy');
            Route::get('', Api\HandleablesController::class . '@index');
            Route::post('', Api\HandleablesController::class . '@store');
        });

        # pages
        Route::get('pages/{page}', Api\PagesController::class . '@show');
        Route::put('pages/{page}', Api\PagesController::class . '@update');
        Route::delete('pages/{page}', Api\PagesController::class . '@destroy');
        Route::get('pages', Api\PagesController::class . '@index');
        Route::post('pages', Api\PagesController::class . '@store');

        # posts
        Route::get('posts/{post}', Api\PostsController::class . '@show');
        Route::put('posts/{post}', Api\PostsController::class . '@update');
        Route::delete('posts/{post}', Api\PostsController::class . '@destroy');
        Route::get('posts', Api\PostsController::class . '@index');
        Route::post('posts', Api\PostsController::class . '@store');

        # search
        Route::get('search', Api\SearchController::class . '@index');

        # sections
        Route::group([
            'prefix' => '{owner_type}/{owner_id}/sections',
            'middleware' => 'request.injections:owner_type,owner_id'
        ], function () {
            Route::get('{id}/preview', Api\SectionablesController::class . '@preview');
            Route::get('{id}', Api\SectionablesController::class . '@show');
            Route::put('{id}', Api\SectionablesController::class . '@update');
            Route::delete('{id}', Api\SectionablesController::class . '@destroy');
            Route::get('', Api\SectionablesController::class . '@index');
            Route::post('', Api\SectionablesController::class . '@store');
        });

        # terms
        Route::get('terms/{term}', Api\TermsController::class . '@show');
        Route::put('terms/{term}', Api\TermsController::class . '@update');
        Route::delete('terms/{term}', Api\TermsController::class . '@destroy');
        Route::get('terms', Api\TermsController::class . '@index');
        Route::post('terms', Api\TermsController::class . '@store');

        # termables
        Route::group([
            'prefix' => '{termable_type}/{termable_id}/terms',
            'middleware' => 'request.injections:termable_type,termable_id'
        ], function () {
            Route::get('{id}', Api\TermablesController::class . '@show');
            Route::put('{id}', Api\TermablesController::class . '@update');
            Route::delete('{id}', Api\TermablesController::class . '@destroy');
            Route::get('', Api\TermablesController::class . '@index');
            Route::post('', Api\TermablesController::class . '@store');
        });

        # tree
        Route::group([
            'prefix' => '{node_type}/{node_id}/tree',
            'middleware' => 'request.injections:node_type,node_id',
        ], function () {
            Route::post('', Api\TreeController::class . '@store');
        });

        # user / favorites
        Route::group([
            'prefix' => 'users/{code}/favorites',
        ], function () {
            Route::get('{id}', Api\UserFavoritesController::class . '@show');
            Route::delete('{id}', Api\UserFavoritesController::class . '@destroy');
            Route::get('', Api\UserFavoritesController::class . '@index');
            Route::post('', Api\UserFavoritesController::class . '@store');
        });
    }
);
