<?php

return [
    'extends' => 'belt-content::pages.web.show',
    'path' => 'belt-content::pages.templates.default',
    'builder' => \App\Builders\DefaultBuilder::class,
    'params' => [
        'flavor_text' => '',
        'class' => [
            'col-md-3' => 'default',
            'col-md-12' => 'wide',
        ],
    ]
];