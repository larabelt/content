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
    'default_driver' => env('CLIP_DEFAULT_DRIVER', 'local'),
    'drivers' => [
        'local' => [
            'disk' => 'public',
            'adapter' => \Belt\Content\Adapters\LocalAdapter::class,
            'prefix' => env('APP_ENV'),
            'src' => [
                'root' => sprintf('%s/storage', env('APP_URL')),
            ],
            'secure' => [
                'root' => sprintf('%s/storage', env('APP_URL'))
            ],
        ],
        'cloudinary' => [
            'disk' => 'cloudinary',
            'adapter' => \Belt\Content\Adapters\CloudinaryAdapter::class,
            'prefix' => env('APP_ENV'),
            'src' => [
                'root' => env('CLOUDINARY_SRC'),
            ],
            'secure' => [
                'root' => env('CLOUDINARY_SECURE'),
            ],
        ],
        's3' => [
            'disk' => 's3',
            'adapter' => \Belt\Content\Adapters\S3LambdaAdapter::class,
            'prefix' => env('APP_ENV'),
            'src' => [
                'root' => sprintf('http://%s', env('AWS_CLOUDFRONT')),
            ],
            'secure' => [
                'root' => sprintf('https://%s', env('AWS_CLOUDFRONT')),
            ],
        ]
    ],
    'resize' => [
        'local_driver' => 'local',
        'image_driver' => 'gd',
        'models' => [],
    ],
];