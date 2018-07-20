<?php

return [
    'label' => 'Alias (show associated item, no redirection)',
    'class' => \Belt\Content\HandleResponses\AliasHandleResponse::class,
    'show_default' => true,
    'show_handleable' => true,
    'show_target' => false,
];