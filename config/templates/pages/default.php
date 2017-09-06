<?php

return [
    'extends' => 'belt-content::pages.web.show',
    'path' => 'belt-content::pages.templates.default',
    'builder' => \App\Builders\DefaultBuilder::class,
    'can_create_params' => true,
    'params' => [
        'flavor_text' => '',
        'class' => [
            'col-md-3' => 'default',
            'col-md-12' => 'wide',
        ],
    ]
];