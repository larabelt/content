<?php

use Belt\Content\Http\Controllers\Web;

# pages
Response::macro('pages', function ($page) {

    $controller = app()->make(Web\PagesController::class);
    $response = $controller->callAction('show', ['page' => $page]);

    return Response::make($response);
});

# posts
Response::macro('posts', function ($post) {

    $controller = app()->make(Web\PostsController::class);
    $response = $controller->callAction('show', ['post' => $post]);

    return Response::make($response);
});

# lists
Response::macro('lists', function ($list) {

    $controller = app()->make(Web\ListsController::class);
    $response = $controller->callAction('show', ['list' => $list]);

    return Response::make($response);
});
