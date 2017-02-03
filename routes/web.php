<?php

use Ohio\Content;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {

    # pages
    Route::get('page/{slug}/preview', Content\Http\Controllers\Web\PagesController::class . '@preview');
    Route::get('page/{slug}', Content\Http\Controllers\Web\PagesController::class . '@show');
    Route::get('pages', function () {
        return view('ohio-core::base.web.home');
    });
});