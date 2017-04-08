<?php

namespace Belt\Content;

use Belt;
use Belt\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Favorite
 * @package Belt\Content
 */
class Favorite extends Model
{

    /**
     * @var string
     */
    protected $morphClass = 'favorites';

    /**
     * @var string
     */
    protected $table = 'favorites';

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function favoriteable()
    {
        return $this->morphTo();
    }

    /**
     * Associated user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}