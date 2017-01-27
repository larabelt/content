<?php

Route::group([
    'prefix' => 'admin/ohio/content',
    'middleware' => ['web', 'auth']
],
    function () {

        # admin/ohio/content home
        Route::get('{any?}', function () {
            return view('ohio-content::base.admin.dashboard');
        })->where('any', '(.*)');

    }
);