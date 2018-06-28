<?php

namespace Belt\Content\Adapters;

use Belt\Content\Helpers\ClipHelper;
use Belt\Content\Helpers\SrcHelper;

/**
 * Class S3Adapter
 * @package Belt\Content\Adapters
 */
class S3LambdaAdapter extends BaseAdapter implements AdapterInterface
{
    /**
     * @param $driver
     */
    public static function loadMacros($driver)
    {
        if (!SrcHelper::hasMacro($driver)) {
            SrcHelper::macro($driver, function (ClipHelper $helper) {

                $attachment = $helper->getAttachment();
                $adapter = $attachment->adapter();
                $w = $helper->param('width');
                $h = $helper->param('height');

                $src = $attachment->src;

                if ($w || $h) {
                    $resizeDir = sprintf('%sx%s', $w, $h);
                    $src = BaseAdapter::normalizePath([
                        $adapter->config('src.root'),
                        $resizeDir,
                        $attachment->path,
                        $attachment->name,
                    ]);
                }

                $src = str_replace(['http://', 'https://', 'http:/', 'https:/'], '//', $src);

                return $src;
            });
        }
    }

}