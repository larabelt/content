<?php

namespace Belt\Content\Search\Elastic;

use Belt\Core\Pagination\BaseLengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Scout\EngineManager;

/**
 * Class DefaultLengthAwarePaginator
 * @package Belt\Core\Pagination
 */
class ElasticSearchPaginator extends BaseLengthAwarePaginator
{

    /**
     * Build pagination query.
     *
     * @return ElasticSearchPaginator
     */
    public function build()
    {
        $request = $this->request;

        /**
         * @var $engine \Belt\Content\Search\Elastic\ElasticEngine
         */
        $engine = app(EngineManager::class)->driver('elastic');

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

        $this->setPaginator($paginator);

        return $this;
    }

}