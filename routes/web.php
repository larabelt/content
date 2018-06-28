<?php

use Belt\Content\Http\Controllers\Web;

Route::group(['middleware' => ['web']], function () {

    # clippable
    Route::pattern('clippable_id', '[0-9]+');
    Route::group([
        'prefix' => '{clippable_type}/{clippable_id}/attachments',
        'middleware' => 'request.injections:clippable_type,clippable_id'
    ], function () {
        Route::get('{any?}', Web\ClippablesController::class . '@show')->where('any', '(.*)');
    });

    # lists
    Route::get('lists/{list}/{slug?}', Web\ListsController::class . '@show');

    # pages
    Route::get('pages/{page}/{slug?}', Web\PagesController::class . '@show');
    Route::get('pages', function () {
        return view('belt-core::base.web.home');
    });

    # posts
    Route::get('posts/{post}/{slug?}', Web\PostsController::class . '@show');
    Route::get('posts', function () {
        return view('belt-core::base.web.home');
    });

    # search
    Route::get('search', Web\SearchController::class . '@index');

    # sections
    Route::get('sections/{section}/preview', Web\SectionsController::class . '@preview');

    # terms
    Route::get('terms/{term}', Web\TermsController::class . '@show');
    Route::get('terms', function () {
        return view('belt-core::base.web.home');
    });

});