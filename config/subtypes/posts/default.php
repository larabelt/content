<?php

return [

    // Required. A blade view path to the main subtype layout.
    'path' => 'belt-content::posts.subtypes.default',

    // A blade view path that can be extended by the layout found in :path.
    'extends' => 'belt-content::posts.web.show',

    // The human-readable name of your subtype.
    'label' => '',

    // A short description of subtype.
    'description' => '',

    // A builder class that extends \Belt\Content\Builders\BaseBuilder,
    // that will run custom code when a new templatable object is created.
    'builder' => null,

    // A blade layout that show can show a snapshot of what the subtypes structure and/or style will look like when compiled.
    'preview' => 'belt-content::sections.previews.default',

    // By default, compiled views are cached. Set the value below to false, to avoid this behavior.
    'force_compile' => false,

    // Sectionable. Allow highly customizable page to be built via the Sections tab.
    'sectionable' => false,

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

    ],

];