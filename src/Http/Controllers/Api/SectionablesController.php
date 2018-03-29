<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Helpers\MorphHelper;
use Belt\Content\Behaviors\HasSectionsInterface;
use Belt\Content\Http\Requests;
use Belt\Content\Section;
use Belt\Content\Services\CompileService;
use Illuminate\Http\Request;

class SectionablesController extends ApiController
{

    /**
     * @var Section
     */
    public $sections;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    /**
     * @var CompileService
     */
    public $service;

    public function __construct(Section $section, MorphHelper $morphHelper)
    {
        $this->sections = $section;
        $this->morphHelper = $morphHelper;
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

    public function owner($owner_type, $owner_id)
    {
        $owner = $this->morphHelper->morph($owner_type, $owner_id);

        return $owner ?: $this->abort(404);
    }

    /**
     * @return CompileService
     */
    public function service()
    {
        return $this->service = $this->service ?: new CompileService();
    }

    /**
     * Cache sections
     *
     * @param $owner
     */
    public function cache($owner)
    {
        if ($owner instanceof HasSectionsInterface) {
            $this->service()->cache($owner, true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $owner_type, $owner_id)
    {

        $owner = $this->owner($owner_type, $owner_id);

        $this->authorize('view', $owner);

        $request = Requests\PaginateSections::extend($request);

        $request->merge([
            'owner_id' => $owner->id,
            'owner_type' => $owner->getMorphClass()
        ]);

        //$owner->reconcileTemplateParams();

        $paginator = $this->paginator($this->sections->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param  Requests\StoreSection $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreSection $request, $owner_type, $owner_id)
    {
        $owner = $this->owner($owner_type, $owner_id);

        $this->authorize('update', $owner);

        $input = $request->all();

        $section = $this->sections->create([
            'owner_id' => $input['owner_id'],
            'owner_type' => $input['owner_type'],
            'sectionable_type' => $input['sectionable_type'],
            'parent_id' => array_get($input, 'parent_id'),
        ]);

        $this->set($section, $input, [
            'sectionable_id',
            'template',
            'heading',
            'before',
            'after',
        ]);

        $section->save();

        $this->cache($owner);

        $this->itemEvent('created', $section);
        $this->itemEvent('sections.created', $owner);

        return response()->json($section, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($owner_type, $owner_id, $id)
    {
        $owner = $this->owner($owner_type, $owner_id);

        $this->authorize('view', $owner);

        $section = $this->section($id, $owner);

        //$section->reconcileTemplateParams();

        $section->config = $section->getTemplateConfig();

        return response()->json($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateSection $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateSection $request, $owner_type, $owner_id, $id)
    {

        $owner = $this->owner($owner_type, $owner_id);

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

        $this->cache($owner);

        $this->itemEvent('updated', $section);
        $this->itemEvent('sections.updated', $owner);

        return response()->json($section);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($owner_type, $owner_id, $id)
    {
        $owner = $this->owner($owner_type, $owner_id);

        $this->authorize('update', $owner);

        $section = $this->section($id, $owner);

        $section->delete();

        $this->cache($owner);

        $this->itemEvent('deleted', $section);
        $this->itemEvent('sections.deleted', $owner);

        return response()->json(null, 204);
    }
}
