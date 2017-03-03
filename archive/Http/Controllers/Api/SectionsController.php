<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Section;
use Belt\Content\Http\Requests;

/**
 * Class SectionsController
 * @package Belt\Content\Http\Controllers\Api
 */
class SectionsController extends ApiController
{

    /**
     * @var Section
     */
    public $section;

    /**
     * ApiController constructor.
     * @param Section $section
     */
    public function __construct(Section $section)
    {
        $this->sections = $section;
    }

    /**
     * @param $id
     */
    public function get($id)
    {
        return $this->sections->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateSections $request)
    {
        $this->authorize('index', Section::class);

        $paginator = $this->paginator($this->sections->query(), $request->reCapture());

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreSection $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreSection $request)
    {
        $this->authorize('create', Section::class);

        $input = $request->all();

        $section = $this->sections->create([
            'sectionable_id' => array_get($input, 'sectionable_id'),
            'sectionable_type' => $input['sectionable_type'],
        ]);

        $this->set($section, $input, [
            'parent_id',
            'template',
            'heading',
            'before',
            'after',
        ]);

        $section->save();

        return response()->json($section, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = $this->get($id);

        $this->authorize('view', $section);

        return response()->json($section);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        $section = $this->get($id);

        $this->authorize('view', $section);

        return view($section->template_view, ['section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateSection $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateSection $request, $id)
    {
        $section = $this->get($id);

        $this->authorize('update', $section);

        $input = $request->all();

        $this->set($section, $input, [
            'template',
            'parent_id',
            'template',
            'heading',
            'before',
            'after',
        ]);

        $section->save();

        return response()->json($section);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = $this->get($id);

        $this->authorize('delete', $section);

        $section->delete();

        return response()->json(null, 204);
    }
}