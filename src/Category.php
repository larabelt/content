<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model {

    use NodeTrait;
    use Ohio\Core\Behaviors\SluggableTrait;
    use Ohio\Content\Behaviors\ContentTrait;

    protected $morphClass = 'categories';

    protected $table = 'categories';

    protected $fillable = ['name', 'body'];

}