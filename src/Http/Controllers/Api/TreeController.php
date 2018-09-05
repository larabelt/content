<?php

namespace Belt\Content\Http\Controllers\Api;

use Morph;
use Belt\Core\Helpers\MorphHelper;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Core\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TreeController extends ApiController
{

    use Morphable;

    /**
     * @param $node_type
     * @param $node_id
     * @return Model
     */
    public function node($node_type, $node_id)
    {
        $node = $this->morph($node_type, $node_id);

        return $node ?: $this->abort(404);
    }

    /**
     * Store a newly created resource in core.
     *
     * @todo Validation, Testing
     * @todo alternative to $node->owner
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $node_type, $node_id)
    {
        $node = $this->node($node_type, $node_id);

        if ($owner = $node->owner) {
            $this->authorize('update', $owner);
        } else {
            $this->authorize('update', $node);
        }

        $neighbor = $this->node($node_type, $request->get('neighbor_id'));

        $move = $request->get('move');

        if ($move == 'before') {
            $result = $node->insertBeforeNode($neighbor);
        }

        if ($move == 'after') {
            $result = $node->insertAfterNode($neighbor);
        }

        if ($move == 'in') {
            $result = $neighbor->appendNode($node);
        }

        return response()->json([$result], 201);
    }

}
