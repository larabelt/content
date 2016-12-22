<?php

namespace Ohio\Content\Tag\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Ohio\Content\Tag\Tag;
use Ohio\Content\Tag\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;

trait TaggableControllerTrait
{

    /**
     * @var Tag
     */
    public $tagRepo;

    /**
     * @var Model
     */
    public $taggable;

    public function tagRepo()
    {
        return $this->tagRepo ?: $this->tagRepo = new Tag();
    }

    public function getTag($id, $taggable = null)
    {
        $qb = $this->tagRepo()->query();

        if ($taggable) {
            $qb->tagged($taggable->getMorphClass(), $taggable->id);
        }

        $tag = $qb->where('tags.id', $id)->first();

        return $tag ?: $this->abort(404);
    }

    public function getTaggable($taggable_id)
    {

        if ($this->taggable) {
            return $this->taggable;
        }

        $taggable = (new $this->taggable_class)->find($taggable_id);

        return $taggable ? $this->taggable = $taggable : $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateTags $request, $taggable_id)
    {
        $request->reCapture();

        $taggable = $this->getTaggable($taggable_id);

        $request->merge([
            'taggable_id' => $taggable->id,
            'taggable_type' => $taggable->getMorphClass()
        ]);

        $paginator = $this->paginator($this->tagRepo()->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\AttachTag $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AttachTag $request, $taggable_id)
    {
        $taggable = $this->getTaggable($taggable_id);

        $id = $request->get('id');

        if ($taggable->tags->contains($id)) {
            $this->abort(422, ['id' => ['tag already attached']]);
        }

        $taggable->tags()->attach($id);

        return response()->json($this->getTag($id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($taggable_id, $id)
    {
        $taggable = $this->getTaggable($taggable_id);

        $tag = $this->getTag($id, $taggable);

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($taggable_id, $id)
    {
        $taggable = $this->getTaggable($taggable_id);

        if (!$taggable->tags->contains($id)) {
            $this->abort(422, ['id' => ['tag not attached']]);
        }

        $taggable->tags()->detach($id);

        return response()->json(null, 204);
    }
}
