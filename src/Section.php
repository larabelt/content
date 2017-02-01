<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class Section extends Model
{
    use SortableTrait;
    use Ohio\Content\Behaviors\ContentTrait;

    protected $morphClass = 'sections';

    protected $table = 'sections';

    protected $fillable = ['name', 'body'];

    protected static $sortableGroupField = 'page_id';

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}