<?php

namespace Belt\Content\Http\Controllers;

use Belt\Core\Http\Controllers\BaseController;
use Illuminate\Http\Request;

/**
 * Class CatchAllController
 * @package Belt\Content\Http\Controllers\Web
 */
class CatchAllController extends BaseController
{
    use HandleResponses;

    /**
     * Display the specified resource.
     * @return \Illuminate\View\View
     */
    public function web(Request $request)
    {
        return $this->getHandledResponse($request);
    }

}