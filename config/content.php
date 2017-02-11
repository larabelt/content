<?php

return [
    'templates' => [
        'blocks' => [
            'default' => [
                'label' => 'Default Block',
                'view' => 'ohio-content::blocks.sections.default'
            ],
        ],
        'embeds' => [
            'breadcrumbs' => [
                'label' => 'Breadcrumbs',
                'view' => 'ohio-menu::menus.sections.breadcrumbs'
            ],
            'contact' => [
                'label' => 'Contact Form',
                'view' => 'ohio-core::contact.sections.default'
            ]
        ],
        'files' => [
            'default' => [
                'label' => 'Default File',
                'view' => 'ohio-storage::files.sections.default'
            ],
        ],
        'menus' => [
            'default' => [
                'label' => 'Example Menu',
                'view' => 'ohio-menu::menus.sections.default'
            ],
        ],
        'pages' => [
            'default' => [
                'label' => 'Default Page',
                'view' => 'ohio-content::pages.templates.default'
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
                'view' => 'ohio-content::touts.sections.default'
            ],
        ],
    ],
];