<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Content\Http\Controllers\Compiler;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Term;

/**
 * Class TermsController
 * @package Belt\Content\Http\Controllers\Web
 */
class TermsController extends BaseController
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
     * @param Term $term
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(Term $term)
    {
        if (!$term->is_active) {
            try {
                $this->authorize('update', $term);
            } catch (\Exception $e) {
                abort(404);
            }
        }

        $compiled = $this->compile($term);

        $owner = $term;

        $view = $term->getSubtypeConfig('extends', 'belt-content::terms.web.show');

        return view($view, compact('owner', 'term', 'compiled'));
    }

}