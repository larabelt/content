<?php

/**
 * Front
 */
Route::group(['middleware' => ['ohio.web']], function () {
    Route::get('pages', function () {
        return view('ohio-core::base.front.home');
    });
});

/**
 * Admin
 */
Route::group([
    'prefix' => 'admin/ohio/content',
    'middleware' => ['ohio.admin']
],
    function () {
        Route::get('{any?}', function () {
            return view('ohio-content::base.admin.dashboard');
        })->where('any', '(.*)');
    }
);