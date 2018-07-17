<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Content\Attachment;
use Belt\Content\Http\Requests;
use Belt\Core\Helpers\MorphHelper;
use Illuminate\Http\Request;

/**
 * Class ClippablesController
 * @package Belt\Content\Http\Controllers\Api
 */
class ClippablesController extends ApiController
{

    use Positionable;

    /**
     * @var Attachment
     */
    public $attachments;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    /**
     * ClippablesController constructor.
     * @param Attachment $attachment
     * @param MorphHelper $morphHelper
     */
    public function __construct(Attachment $attachment, MorphHelper $morphHelper)
    {
        $this->attachments = $attachment;
        $this->morphHelper = $morphHelper;
    }

    /**
     * @param $id
     * @param null $clippable
     */
    public function attachment($id, $clippable = null)
    {
        $qb = $this->attachments->with('resizes');

        if ($clippable) {
            $qb->attached($clippable->getMorphClass(), $clippable->id);
        }

        $attachment = $qb->where('attachments.id', $id)->first();

        return $attachment ?: $this->abort(404);
    }

    /**
     * @param $clippable_type
     * @param $clippable_id
     */
    public function clippable($clippable_type, $clippable_id)
    {
        $clippable = $this->morphHelper->morph($clippable_type, $clippable_id);

        return $clippable ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $clippable_type, $clippable_id)
    {

        $request = Requests\PaginateClippables::extend($request);

        $owner = $this->clippable($clippable_type, $clippable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $request->merge([
            'clippable_id' => $owner->id,
            'clippable_type' => $owner->getMorphClass()
        ]);

        $paginator = $this->paginator($this->attachments->with('resizes'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\AttachAttachment $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AttachAttachment $request, $clippable_type, $clippable_id)
    {
        $owner = $this->clippable($clippable_type, $clippable_id);

        $this->authorize('update', $owner);

        $id = $request->get('id');

        $attachment = $this->attachment($id);

        if ($owner->attachments->contains($id)) {
            $this->abort(422, ['id' => ['attachment already attached']]);
        }

        $owner->attachments()->attach($id);

        $owner->touch();

        $this->itemEvent('attachments.attached', $owner);


        return response()->json($attachment, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateClippable $request
     * @param  string $clippable_type
     * @param  string $clippable_id
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateClippable $request, $clippable_type, $clippable_id, $id)
    {
        $owner = $this->clippable($clippable_type, $clippable_id);

        $this->authorize('update', $owner);

        $attachment = $this->attachment($id, $owner);

        $this->repositionHasManyThrough($request, $id, $owner->attachments, $owner->attachments());

        try {
            if ($this->authorize('update', $attachment)) {
                $input = $request->all();
                $this->set($attachment, $input, [
                    'title',
                    'note',
                    'credits',
                    'alt',
                    'target_url',
                    'nickname',
                ]);
                $attachment->save();
                $this->itemEvent('attachments.updated', $owner);
            }
        } catch (\Exception $e) {

        }

        return response()->json($attachment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($clippable_type, $clippable_id, $id)
    {
        $owner = $this->clippable($clippable_type, $clippable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $attachment = $this->attachment($id, $owner);

        return response()->json($attachment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($clippable_type, $clippable_id, $id)
    {
        $owner = $this->clippable($clippable_type, $clippable_id);

        $this->authorize('update', $owner);

        if (!$owner->attachments->contains($id)) {
            $this->abort(422, ['id' => ['attachment not attached']]);
        }

        $owner->attachments()->detach($id);

        $owner->touch();

        $this->itemEvent('attachments.detached', $owner);

        return response()->json(null, 204);
    }
}
