<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Content\Term;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;
use Belt\Core\Http\Controllers\Behaviors\Morphable;

class TermablesController extends ApiController
{

    use Morphable, Positionable;

    /**
     * @var Term
     */
    public $terms;

    /**
     * TermablesController constructor.
     * @param Term $term
     */
    public function __construct(Term $term)
    {
        $this->terms = $term;
    }

    /**
     * @param $id
     * @param null $termable
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     */
    public function term($id, $termable = null)
    {
        $qb = $this->terms->query();

        if ($termable) {
            $qb->term($termable->getMorphClass(), $termable->id);
        }

        $term = $qb->where('terms.id', $id)->first();

        return $term ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $termable_type
     * @param $termable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $termable_type, $termable_id)
    {

        $owner = $this->morphable($termable_type, $termable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $request = Requests\PaginateTermables::extend($request);

        $request->merge([
            'termable_id' => $owner->id,
            'termable_type' => $owner->getMorphClass()
        ]);

        $paginator = $this->paginator($this->terms->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in content.
     *
     * @param Requests\AttachTerm $request
     * @param $termable_type
     * @param $termable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\AttachTerm $request, $termable_type, $termable_id)
    {
        $owner = $this->morphable($termable_type, $termable_id);

        $this->authorize('update', $owner);

        $id = $request->get('id');

        $term = $this->term($id);

        if (!$owner->terms->contains($id)) {
            $owner->terms()->attach($id);
            $owner->load('terms');
            $owner->touch();
            $this->itemEvent('terms.attached', $owner);
        }

        return response()->json($term, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $termable_type
     * @param $termable_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($termable_type, $termable_id, $id)
    {
        $owner = $this->morphable($termable_type, $termable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $term = $this->term($id, $owner);

        return response()->json($term);
    }

    /**
     * Remove the specified resource from content.
     *
     * @param $termable_type
     * @param $termable_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($termable_type, $termable_id, $id)
    {
        $owner = $this->morphable($termable_type, $termable_id);

        $this->authorize('update', $owner);

        $this->term($id, $owner);

        if ($owner->terms->contains($id)) {
            $owner->terms()->detach($id);
            $owner->load('terms');
            $owner->touch();
            $this->itemEvent('terms.detached', $owner);
        }

        return response()->json(null, 204);
    }
}
