<?php

use Belt\Content\Http\Controllers\Web;

Route::group(['middleware' => ['web']], function () {

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

});