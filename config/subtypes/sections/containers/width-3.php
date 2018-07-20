<?php

return [

    // Required. A blade view path to the main subtype layout.
    'path' => 'belt-content::sections.sections.width-3',

    // A blade view path that can be extended by the layout found in :path.
    'extends' => null,

    // The human-readable name of your subtype.
    'label' => '',

    // A short description of subtype.
    'description' => '',

    // A builder class that extends \Belt\Content\Builders\BaseBuilder,
    // that will run custom code when a new templatable object is created.
    'builder' => null,

    // A blade layout that show can show a snapshot of what the subtypes structure and/or style will look like when compiled.
    'preview' => 'belt-content::sections.previews.default',

    /*
    | A set of custom parameters that belong to the templatable object.
    |
    | Each parameters has the following configuration options:
    |
    | @type:        Required. The type of input to be used in the admin UX,
    |               ie: text, textarea, select, editor or other properly added custom values.
    |
    | @label:       The human-readable name of the parameter.
    |
    | @description: A short description of parameter.
    |
    | @options:     The list of available options where type="select". Option keys are machine-readable.
    |               Option values will be used as human-readable labels.
    */

    'params' => [
        'heading' => [
            'type' => 'text',
            'label' => 'Heading',
            'description' => 'Optional heading. Will appear at the top of the section.',
        ],
        'before' => [
            'type' => 'editor',
            'label' => 'Upper Content',
            'description' => 'Optional HTML body. Will appear above any nested items.',
        ],
        'after' => [
            'type' => 'editor',
            'label' => 'Lower Content',
            'description' => 'Optional HTML body. Will appear below above any nested items.',
        ],
    ],

];