<?php

return [
    'label' => 'Not Found (show 404 page, no redirection)',
    'class' => \Belt\Content\HandleResponses\NotFoundResponse::class,
    'show_default' => false,
    'show_handleable' => false,
    'show_target' => false,
];