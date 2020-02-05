<?php

use Belt\Content\Http\Controllers\Web;

# pages
Response::macro('pages', function ($page, $options = []) {

    $controller = app()->make(Web\PagesController::class);
    $response = $controller->callAction('show', ['page' => $page]);

    foreach($options as $option => $value) {
        $response->with($option, $value);
    }
    
    return Response::make($response);
});

# posts
Response::macro('posts', function ($post, $options = []) {

    $controller = app()->make(Web\PostsController::class);
    $response = $controller->callAction('show', ['post' => $post]);

    foreach($options as $option => $value) {
        $response->with($option, $value);
    }

    return Response::make($response);
});

# lists
Response::macro('lists', function ($list, $options = []) {

    $controller = app()->make(Web\ListsController::class);
    $response = $controller->callAction('show', ['list' => $list]);

    foreach($options as $option => $value) {
        $response->with($option, $value);
    }

    return Response::make($response);
});
