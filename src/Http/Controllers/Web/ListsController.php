<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Content\Http\Controllers\Compiler;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Lyst;

/**
 * Class ListsController
 * @package Belt\Content\Http\Controllers\Web
 */
class ListsController extends BaseController
{

    use Compiler;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display the specified resource.
     *
     * @param  List $list
     *
     * @return \Illuminate\View\View
     */
    public function show(Lyst $list)
    {
        if (!$list->is_active) {
            try {
                $this->authorize('update', $list);
            } catch (\Exception $e) {
                abort(404);
            }
        }

        $compiled = $this->compile($list);

        $owner = $list;

        $view = $list->getSubtypeConfig('extends', 'belt-spot::lists.web.show');

        return view($view, compact('owner', 'list', 'compiled'));
    }

}