<?php

return [
    'sections' => [
        'blocks' => [
            'default' => [
                'label' => 'Default Block',
                'view' => 'ohio-content::block.sections.default'
            ],
        ],
        'embeds' => [
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
    ]
];