<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Core\Pagination\BaseLengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class SearchController
 * @package Belt\Core\Http\Controllers\Auth
 */
class SearchController extends BaseController
{

    /**
     * Show search results
     *
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(PaginateRequest $request)
    {

        $request->reCapture();

        $classes = config('belt.search.classes');

        /**
         * @var $pager LengthAwarePaginator
         */
        $pager = null;
        $paginators = new Collection();
        foreach ($classes as $modelClass => $paginateClass) {
            $builder = new BaseLengthAwarePaginator($modelClass::query(), new $paginateClass($request->all()));
            if ($builder && $builder->paginator) {
                $paginators->push($builder->paginator);
                if (!$pager || $builder->paginator->lastPage() > $pager->lastPage()) {
                    $pager = $builder->paginator;
                    $pager->withPath('search');
                }
            }
        }

        return view('belt-content::search.web.index', compact('paginators', 'pager'));
    }

}
