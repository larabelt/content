<?php

namespace Belt\Content\Http\Controllers\Api;

use Auth, Cookie;
use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\User;
use Belt\Core\Helpers\MorphHelper;
use Belt\Content\Favorite;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

class UserFavoritesController extends ApiController
{

    /**
     * primary favorites column
     *
     * can be "user_id" or "guid"
     *
     * @var string
     */
    public $column = 'user_id';

    /**
     * value to query against $column
     *
     * @var int|string
     */
    public $code;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Favorite
     */
    public $favorite;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    /**
     * UserFavoritesController constructor.
     * @param User $user
     * @param Favorite $favorite
     * @param MorphHelper $morphHelper
     */
    public function __construct(User $user, Favorite $favorite, MorphHelper $morphHelper)
    {
        $this->user = $user;
        $this->favorite = $favorite;
        $this->morphHelper = $morphHelper;
    }

    /**
     * @param $code
     */
    public function parseCode($code)
    {
        $auth = Auth::user();

        $this->code = $code;

        /**
         * if "self" is sent as code, set it as auth.id first,
         * then as cooke.guid second
         */
        if ($code == 'self') {
            $this->code = $auth->id ?? Cookie::get('guid') ?? null;
        }

        /**
         * if the code not numeric then it's guid string
         */
        if (!is_numeric($this->code)) {
            $this->column = 'guid';
        }

        /**
         * no code at all? GTFO.
         */
        if (!$this->code) {
            $this->abort(403);
        }

        /**
         * are we going by user_id? let's make sure the api user is authorized
         */
        if ($this->column == 'user_id') {
            $user = $this->user->find($this->code);
            $this->authorize('update', $user);
        }

        /**
         * are we going by guid string? let's make another authorization check
         * just in case
         */
        if ($this->column == 'guid') {
            if (Cookie::get('guid') != $this->code) {
                $this->authorize('create', User::class);
            }
        }

    }

    /**
     * @param $id
     */
    public function favorite($id)
    {
        $favorite = $this->favorite->with('favoriteable')
            ->where($this->column, $this->code)
            ->where('id', $id)
            ->first();

        return $favorite ?: $this->abort(404);
    }

    /**
     * @param $favoriteable_type
     * @param $favoriteable_id
     */
    public function favoriteable($favoriteable_type, $favoriteable_id)
    {
        $favoriteable = $this->morphHelper->morph($favoriteable_type, $favoriteable_id);

        return $favoriteable ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param mixed $code
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $code)
    {
        $this->parseCode($code);

        $request = Requests\PaginateFavorites::extend($request);

        $request->merge([$this->column => $this->code]);

        $paginator = $this->paginator($this->favorite->with('favoriteable'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource.
     *
     * @param Requests\StoreFavorite $request
     * @param mixed $code
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreFavorite $request, $code)
    {
        $this->parseCode($code);

        $favoriteable_id = $request->get('favoriteable_id');
        $favoriteable_type = $request->get('favoriteable_type');

        $this->favoriteable($favoriteable_type, $favoriteable_id);

        Favorite::unguard();

        $favorite = $this->favorite->firstOrCreate([
            $this->column => $this->code,
            'favoriteable_id' => $favoriteable_id,
            'favoriteable_type' => $favoriteable_type,
        ]);

        // to ensure display in json
        $favorite->favoriteable;

        return response()->json($favorite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param mixed $code
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($code, $id)
    {
        $this->parseCode($code);

        $favorite = $this->favorite($id);

        return response()->json($favorite);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param mixed $code
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($code, $id)
    {
        $this->parseCode($code);

        $favorite = $this->favorite($id);

        $favorite->delete();

        return response()->json(null, 204);
    }
}
