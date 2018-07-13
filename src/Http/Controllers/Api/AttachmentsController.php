<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Adapters\AdapterFactory;
use Belt\Content\Attachment;
use Belt\Content\Http\Requests;
use Belt\Content\Adapters\BaseAdapter;
use Illuminate\Http\Request;

/**
 * Class AttachmentsController
 * @package Belt\Content\Http\Controllers\Api
 */
class AttachmentsController extends ApiController
{

    /**
     * @var Attachment
     */
    public $attachments;

    /**
     * @param $driver
     * @return BaseAdapter
     */
    public function adapter($driver)
    {
        return AdapterFactory::up($driver);
    }

    /**
     * ApiController constructor.
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachments = $attachment;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function upload(Request $request)
    {
        $path = $request->get('path') ?: '';

        $driver = $request->get('driver', null);

        $adapter = $this->adapter($driver);

        $data = $adapter->upload($path, $request->file('file'));

        $data = array_merge($request->all(), $data);

        return $data;
    }

    /**
     * @param $id
     * @return Attachment
     */
    public function get($id)
    {
        return $this->attachments->with('resizes')->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], Attachment::class);

        $request = Requests\PaginateAttachments::extend($request);

        $paginator = $this->paginator($this->attachments->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreAttachment $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreAttachment $request)
    {
        $this->authorize('create', Attachment::class);

//        $path = $request->get('path') ?: '';
//
//        $driver = $request->get('driver', null);
//
//        $adapter = $this->adapter($driver);
//
//        $data = $adapter->upload($path, $request->file('file'));
//
//        $input = array_merge($request->all(), $data);

        $input = $this->upload($request);

        $attachment = $this->attachments->createFromUpload($input);

        $this->set($attachment, $input, [
            'team_id',
            'template',
            'is_public',
            'title',
            'note',
            'credits',
            'alt',
            'target_url',
            'nickname',
        ]);

        $attachment->save();

        $this->itemEvent('created', $attachment);

        return response()->json($attachment, 201);
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
        $attachment = $this->get($id);

        $this->authorize(['view', 'create', 'update', 'delete'], $attachment);

        $attachment->append(['config']);

        return response()->json($attachment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateAttachment $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateAttachment $request, $id)
    {
        $attachment = $this->get($id);

        $this->authorize('update', $attachment);

        if ($request->file('file')) {
            $input = $this->upload($request);
            $attachment->unguard();
            $attachment->update($attachment->setAttributesFromUpload($input));
        } else {
            $input = $request->all();
        }

        $this->set($attachment, $input, [
            'team_id',
            'template',
            'is_public',
            'title',
            'note',
            'credits',
            'alt',
            'target_url',
            'nickname',
        ]);

        $attachment->save();

        $this->itemEvent('updated', $attachment);

        return response()->json($attachment);
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
        $attachment = $this->get($id);

        $this->authorize('delete', $attachment);

        $this->itemEvent('deleted', $attachment);

        $attachment->delete();

        return response()->json(null, 204);
    }
}
