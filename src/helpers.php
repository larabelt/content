<?php

use Belt\Content\Attachment;
use Belt\Content\Helpers\ClipHelper;

if (!function_exists('clip')) {
    /**
     * @param Attachment|null $attachment
     * @return ClipHelper
     * @codeCoverageIgnore
     */
    function clip(Attachment $attachment = null)
    {
        return new ClipHelper($attachment);
    }
}