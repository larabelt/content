<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Section extends Model
    implements Ohio\Core\Behaviors\ParamableInterface,
    Ohio\Content\Behaviors\TemplateInterface
{

    use NodeTrait;
    use Ohio\Core\Behaviors\ParamableTrait;
    use Ohio\Content\Behaviors\ContentTrait;
    use Ohio\Content\Behaviors\TemplateTrait;

    protected $morphClass = 'sections';

    protected $table = 'sections';

    protected $fillable = ['name', 'body'];

    protected static $sortableGroupField = 'page_id';

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function sectionable()
    {
        return $this->morphTo();
    }

    public function getTemplateViewAttribute()
    {

        $key = sprintf('ohio.content.templates.%s', $this->sectionable_type);

        return config("$key.$this->template.view") ?: config("$key.default.view");
    }

}