<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Section extends Model {

    use NodeTrait;
    use Ohio\Core\Behaviors\ParamsTrait;
    use Ohio\Content\Behaviors\ContentTrait;

    protected $morphClass = 'sections';

    protected $table = 'sections';

    protected $fillable = ['name', 'body'];

    protected static $sortableGroupField = 'page_id';

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function sectionable()
    {
        return $this->morphTo();
    }

    public function getIsContainerAttribute()
    {
        return $this->page_id;
    }

}