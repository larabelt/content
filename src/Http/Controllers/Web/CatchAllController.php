<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Http\Controllers\HandleResponses;
use Illuminate\Http\Request;

/**
 * Class PagesController
 * @package Belt\Content\Http\Controllers\Web
 */
class CatchAllController extends BaseController
{

    use HandleResponses;

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        return $this->getHandledResponse($request);
    }

}