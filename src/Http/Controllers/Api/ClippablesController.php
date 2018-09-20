<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Content\Attachment;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class ClippablesController
 * @package Belt\Content\Http\Controllers\Api
 */
class ClippablesController extends ApiController
{

    use Morphable, Positionable;

    /**
     * @var Attachment
     */
    public $attachments;

    /**
     * ClippablesController constructor.
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachments = $attachment;
    }

    /**
     * @param $id
     * @param null $clippable
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $clippable_type
     * @param $clippable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $clippable_type, $clippable_id)
    {

        $request = Requests\PaginateClippables::extend($request);

        $clippable = $this->morph($clippable_type, $clippable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $clippable);

        $request->merge([
            'clippable_id' => $clippable->id,
            'clippable_type' => $clippable->getMorphClass()
        ]);

        $paginator = $this->paginator($this->attachments->with('resizes'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\AttachAttachment $request
     * @param $clippable_type
     * @param $clippable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\AttachAttachment $request, $clippable_type, $clippable_id)
    {
        $clippable = $this->morph($clippable_type, $clippable_id);

        $this->authorize('update', $clippable);

        $id = $request->get('id');

        $attachment = $this->attachment($id);

        if ($clippable->attachments->contains($id)) {
            $this->abort(422, ['id' => ['attachment already attached']]);
        }

        $clippable->attachments()->attach($id);

        $clippable->touch();

        $this->itemEvent('attachments.attached', $clippable);


        return response()->json($attachment, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UpdateClippable $request
     * @param $clippable_type
     * @param $clippable_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Requests\UpdateClippable $request, $clippable_type, $clippable_id, $id)
    {
        $clippable = $this->morph($clippable_type, $clippable_id);

        $this->authorize('update', $clippable);

        $attachment = $this->attachment($id, $clippable);

        $this->repositionHasManyThrough($request, $id, $clippable->attachments, $clippable->attachments());

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
                $this->itemEvent('attachments.updated', $clippable);
            }
        } catch (\Exception $e) {

        }

        return response()->json($attachment);
    }

    /**
     * Display the specified resource.
     *
     * @param $clippable_type
     * @param $clippable_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($clippable_type, $clippable_id, $id)
    {
        $clippable = $this->morph($clippable_type, $clippable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $clippable);

        $attachment = $this->attachment($id, $clippable);

        return response()->json($attachment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $clippable_type
     * @param $clippable_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($clippable_type, $clippable_id, $id)
    {
        $clippable = $this->morph($clippable_type, $clippable_id);

        $this->authorize('update', $clippable);

        if (!$clippable->attachments->contains($id)) {
            $this->abort(422, ['id' => ['attachment not attached']]);
        }

        $clippable->attachments()->detach($id);

        $clippable->touch();

        $this->itemEvent('attachments.detached', $clippable);

        return response()->json(null, 204);
    }
}
