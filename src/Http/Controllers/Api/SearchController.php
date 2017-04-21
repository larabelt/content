<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Core\Pagination\BaseLengthAwarePaginator;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = PaginateRequest::extend($request);

        $request->merge([
           'is_active' => true,
           'is_searchable' => true,
        ]);

        $classes = config('belt.search.classes');

        $include = $request->get('include') ? explode(',', $request->get('include')) : [];

        /**
         * @var $pager LengthAwarePaginator
         */
        $pager = null;
        $items = new Collection();
        foreach ($classes as $modelClass => $paginateClass) {

            $morphClass = (new $modelClass)->getMorphClass();

            if ($include && !in_array($morphClass, $include)) {
                continue;
            }

            $builder = new BaseLengthAwarePaginator($modelClass::query(), new $paginateClass($request->all()));
            if ($builder && $builder->paginator) {
                foreach ($builder->paginator->items() as $item) {
//                    $items->push([
//                        'type'=>$item->type,
//                        'id'=>$item->id,
//                        'name' => $item->name
//                    ]);
                    $items->push($item);
                }
                if (!$pager || $builder->paginator->lastPage() > $pager->lastPage()) {
                    $pager = $builder->paginator;
                }
            }
        }

        $paginator = new LengthAwarePaginator(
            $items->toArray(),
            $pager->total(),
            $pager->perPage(),
            $pager->currentPage()
        );

        return response()->json($paginator->toArray());
    }

}
