<?php

return [
    'templates' => [
        'blocks' => [
            'default' => [
                'label' => 'Default Block',
                'view' => 'ohio-content::block.sections.default'
            ],
        ],
        'embeds' => [
            'breadcrumbs' => [
                'label' => 'Breadcrumbs',
                'view' => 'ohio-menu::menu.sections.breadcrumbs'
            ],
            'contact' => [
                'label' => 'Contact Form',
                'view' => 'ohio-core::contact.sections.default'
            ]
        ],
        'files' => [
            'default' => [
                'label' => 'Default File',
                'view' => 'ohio-storage::file.sections.default'
            ],
        ],
        'menus' => [
            'default' => [
                'label' => 'Example Menu',
                'view' => 'ohio-menu::menu.sections.default'
            ],
        ],
        'pages' => [
            'default' => [
                'label' => 'Default Page',
                'view' => 'ohio-content::page.templates.default'
            ]
        ],
        'sections' => [
            'default' => [
                'label' => 'Default Tout',
                'view' => 'ohio-content::section.sections.default'
            ],
        ],
        'touts' => [
            'default' => [
                'label' => 'Default Tout',
                'view' => 'ohio-content::tout.sections.default'
            ],
        ],
    ],
];