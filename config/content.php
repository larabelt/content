<?php

return [
    'handles' => [
        'responses' => [
            'alias' => [
                'label' => 'Alias (show associated item, no redirection)',
                'class' => \Belt\Content\HandleResponses\AliasHandleResponse::class,
                'show_default' => true,
                'show_handleable' => true,
                'show_target' => false,
            ],
            'not-found' => [
                'label' => 'Not Found (show 404 page, no redirection)',
                'class' => \Belt\Content\HandleResponses\NotFoundResponse::class,
                'show_default' => false,
                'show_handleable' => false,
                'show_target' => false,
            ],
            'permanent-redirect' => [
                'label' => 'Permanent Redirect',
                'class' => \Belt\Content\HandleResponses\PermanentRedirectResponse::class,
                'show_default' => false,
                'show_handleable' => true,
                'show_target' => true,
            ],
            'temporary-redirect' => [
                'label' => 'Temporary Redirect',
                'class' => \Belt\Content\HandleResponses\TemporaryRedirectResponse::class,
                'show_default' => false,
                'show_handleable' => true,
                'show_target' => true,
            ],
        ],
    ],
];