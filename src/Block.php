<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Block
 * @package Belt\Content
 */
class Block extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\SectionableInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Sectionable;

    /**
     * @var string
     */
    protected $morphClass = 'blocks';

    /**
     * @var string
     */
    protected $table = 'blocks';

    /**
     * @var array
     */
    protected $fillable = ['name', 'body'];

    /**
     * @param $value
     */
    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}