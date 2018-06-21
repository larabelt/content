<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Term;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

class TermsController extends ApiController
{

    /**
     * @var Term
     */
    public $term;

    /**
     * ApiController constructor.
     * @param Term $term
     */
    public function __construct(Term $term)
    {
        $this->terms = $term;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], Term::class);

        $request = Requests\PaginateTerms::extend($request);

        $paginator = $this->paginator($this->terms->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\StoreTerm $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\StoreTerm $request)
    {
        $this->authorize('create', Term::class);

        $input = $request->all();

        $term = $this->terms->create([
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
        ]);

        $this->set($term, $input, [
            'is_active',
            'parent_id',
            'template',
            'name',
            'slug',
            'body',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $term->save();

        $this->itemEvent('created', $term);

        return response()->json($term, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Term $term
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Term $term)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $term);

        $term->append(['config']);

        return response()->json($term);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UpdateTerm $request
     * @param Term $term
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Requests\UpdateTerm $request, Term $term)
    {
        $this->authorize('update', $term);

        $input = $request->all();

        $this->set($term, $input, [
            'is_active',
            'parent_id',
            'template',
            'name',
            'slug',
            'body',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $term->save();

        $this->itemEvent('updated', $term);

        return response()->json($term);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Term $term
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Term $term)
    {
        $this->authorize('delete', $term);

        $this->itemEvent('deleted', $term);

        $term->delete();

        return response()->json(null, 204);
    }
}
