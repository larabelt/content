<?php

use Belt\Content\Http\Controllers\Web;

Route::group(['middleware' => ['web']], function () {

    # pages
    Route::get('page/{page}/preview', Web\PagesController::class . '@preview');
    Route::get('page/{page}', Web\PagesController::class . '@show');
    Route::get('pages', function () {
        return view('belt-core::base.web.home');
    });

});