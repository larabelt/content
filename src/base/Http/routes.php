<?php

/**
 * Front
 */
Route::group(['middleware' => ['web']], function () {
    Route::get('/pages', function () {
        return view('ohio-core::base.front.home');
    });
});

/**
 * Admin
 */
Route::group([
    'prefix' => 'admin/ohio/content',
    'middleware' => ['web', 'auth.admin']
],
    function () {
        Route::get('{a?}/{b?}/{c?}', function () {
            return view('ohio-content::base.admin.dashboard');
        });
    }
);