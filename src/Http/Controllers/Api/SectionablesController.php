<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Morphable;
use Belt\Content\Http\Controllers\Compiler;
use Belt\Content\Http\Requests;
use Belt\Content\Section;
use Belt\Content\Services\CompileService;
use Illuminate\Http\Request;

class SectionablesController extends ApiController
{

    use Compiler, Morphable;

    /**
     * @var Section
     */
    public $sections;

    /**
     * @var CompileService
     */
    public $service;

    /**
     * SectionablesController constructor.
     * @param Section $section
     */
    public function __construct(Section $section)
    {
        $this->sections = $section;
    }

    public function section($id, $owner = null)
    {
        $qb = $this->sections->query();

        if ($owner) {
            $qb->owned($owner->getMorphClass(), $owner->id);
        }

        $section = $qb->where('sections.id', $id)->first();

        return $section ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $owner_type
     * @param $owner_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $owner_type, $owner_id)
    {

        $owner = $this->morphable($owner_type, $owner_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $request = Requests\PaginateSections::extend($request);

        $request->merge([
            'owner_id' => $owner->id,
            'owner_type' => $owner->getMorphClass()
        ]);

        $paginator = $this->paginator($this->sections->query(), $request);

        foreach ($paginator->paginator->items() as $section) {
            $section->append('preview');
        }

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param Requests\StoreSection $request
     * @param $owner_type
     * @param $owner_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\StoreSection $request, $owner_type, $owner_id)
    {
        $owner = $this->morphable($owner_type, $owner_id);

        $this->authorize('update', $owner);

        $input = $request->all();

        $section = $this->sections->create([
            'owner_id' => $input['owner_id'],
            'owner_type' => $input['owner_type'],
            //'sectionable_type' => $input['sectionable_type'],
            'parent_id' => array_get($input, 'parent_id'),
        ]);

        $this->set($section, $input, [
            //'sectionable_id',
            'template',
            'heading',
            'before',
            'after',
        ]);

        $section->save();

        $this->compile($owner, true);

        $this->itemEvent('created', $section);
        $this->itemEvent('sections.created', $owner);

        return response()->json($section, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $owner_type
     * @param $owner_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($owner_type, $owner_id, $id)
    {
        $owner = $this->morphable($owner_type, $owner_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $section = $this->section($id, $owner);

        $section->append('preview');

        $section->config = $section->getTemplateConfig();

        return response()->json($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UpdateSection $request
     * @param $owner_type
     * @param $owner_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Requests\UpdateSection $request, $owner_type, $owner_id, $id)
    {

        $owner = $this->morphable($owner_type, $owner_id);

        $this->authorize('update', $owner);

        $section = $this->section($id, $owner);

        $input = $request->all();

        $this->set($section, $input, [
            'sectionable_id',
            'template',
            'parent_id',
            'template',
            'heading',
            'before',
            'after',
        ]);

        $section->save();

        $this->compile($owner, true);

        $this->itemEvent('updated', $section);
        $this->itemEvent('sections.updated', $owner);

        return response()->json($section);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param $owner_type
     * @param $owner_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($owner_type, $owner_id, $id)
    {
        $owner = $this->morphable($owner_type, $owner_id);

        $this->authorize('update', $owner);

        $section = $this->section($id, $owner);

        $section->delete();

        $this->compile($owner, true);

        $this->itemEvent('deleted', $section);
        $this->itemEvent('sections.deleted', $owner);

        return response()->json(null, 204);
    }
}
