<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Core\Pagination\DefaultLengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Scout\EngineManager;

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
        $engine = $request->get('engine', 'local');

        if (method_exists($this, $engine)) {
            return $this->$engine($request);
        }

        abort(404);
    }

    /**
     * Show search results
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function local(Request $request)
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

            $morphKey = (new $modelClass)->getMorphClass();

            if ($include && !in_array($morphKey, $include)) {
                continue;
            }

            $builder = new DefaultLengthAwarePaginator($modelClass::query(), new $paginateClass($request->all()));
            $builder->build();
            if ($builder && $builder->paginator) {
                foreach ($builder->paginator->items() as $item) {
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

    /**
     * Show search results
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function elastic(Request $request)
    {
        /**
         * @var $engine \Belt\Content\Search\Elastic\ElasticEngine
         */
        $engine = app(EngineManager::class)->driver('elastic');

        # request
        $request = PaginateRequest::extend($request);
        $request->merge([
            'is_active' => true,
            'is_searchable' => true,
        ]);

        # include / types
        if ($include = $request->get('include', [])) {
            $include = explode(',', $include);
        }

        # class / config
        $modifiers = [];
        foreach (config('belt.search.classes') as $modelClass => $paginateClass) {
            $morphKey = (new $modelClass)->getMorphClass();
            if ($include && !in_array($morphKey, $include)) {
                continue;
            }
            $queryModifiers = (new $paginateClass)->queryModifiers;
            foreach ($queryModifiers as $queryModifier) {
                if (!in_array($queryModifier, $modifiers)) {
                    $modifiers[] = $queryModifier;
                }
            }
        }

        $engine->setRequest($request);
        $engine->modifiers = $modifiers;

        # execute search
        $results = $engine->performSearch();
        $items = $engine->morphResults($results);

        $paginator = new LengthAwarePaginator(
            $items->toArray(),
            array_get($results, 'hits.total', $items->count()),
            $request->perPage(),
            $request->page()
        );

        return response()->json($paginator->toArray());
    }

}
